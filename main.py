from dotenv import load_dotenv
import os
import base64
import json
from requests import post, get
import mysql.connector

connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="spotify api"
)
cursor = connection.cursor()

load_dotenv()

client_id = os.getenv("CLIENT_ID")
client_secret = os.getenv("CLIENT_SECRET")
print(client_id, client_secret)

def get_token():
    auth_string = client_id + ":" + client_secret
    auth_bytes = auth_string.encode("utf-8")
    auth_base64 = str(base64.b64encode(auth_bytes), "utf-8")

    url = "https://accounts.spotify.com/api/token"
    headers = {
        "Authorization": "Basic " + auth_base64,
        "Content-Type": "application/x-www-form-urlencoded"
    }
    data = {"grant_type": "client_credentials"}
    result = post(url, headers=headers, data=data)
    json_result = json.loads(result.content)
    token = json_result["access_token"]
    return token

def get_auth_header(token):
    return {"Authorization": "Bearer " + token}

def search_for_podcasts(token, user_key_words):
    sql = "INSERT INTO podcasts (Title, Description, Image, URL, ID) VALUES (%s, %s,%s,%s,%s)"
    if not user_key_words:
        print("Error: No search query provided.")
        return

    url = "https://api.spotify.com/v1/search"
    headers = get_auth_header(token)

    general_key_words = ["black girl", "black+men", "black+women"]
    combined_user_key_words =  f"{user_key_words.replace(' ', '+')}"
    combined_keywords = "+".join(general_key_words) + f" {combined_user_key_words}"

    # Replace spaces with %20 in the query
    query = f"q={combined_keywords.replace(' ', '+')}&type=episode&limit=20&market=CA"


    query_url = url + "?" + query
    
    result = get(query_url, headers=headers)
    print(query_url)
    if result.status_code == 200:
        json_result = result.json()
        for item in json_result.get('episodes', {}).get('items', []):
            name = item.get('name', 'N/A')
            description = item.get('description', '').lower() if 'description' in item else ''
            image_url = item.get('images', [{}])[0].get('url', 'N/A')
            podcast_url = item.get('external_urls', {}).get('spotify', 'N/A')
            description = item.get('description', 'N/A')
            episode_id = item.get('id')
            print("Name:", name)
            print("Image URL:", image_url)
            print("Description:", description)
            print("Podcast URL:", podcast_url)
            print("Episode ID: ", episode_id)
            print("\n")  

            cursor.execute("SELECT * FROM podcasts WHERE ID = %s", (episode_id,))
            existing_record = cursor.fetchall()     
            print(existing_record)

            if not existing_record:
                values = (name, description, image_url, podcast_url, episode_id)
                cursor.execute("INSERT INTO podcasts (Title, Description, Image, URL, ID)VALUES (%s, %s, %s, %s, %s)", values)
    else:
        print(f"Error: {result.status_code} - {result.text}")
        

token = get_token()
search_for_podcasts(token, "health")

# Commit changes
connection.commit()