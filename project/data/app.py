from dotenv import load_dotenv
import sys
import re
import os
import base64
import json
from flask import Flask, request, jsonify, redirect, url_for,render_template
from requests import post, get
import mysql.connector

app = Flask(__name__)

connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="spotify_api",
)
print("Connected to the database.")
cursor = connection.cursor()
if len(sys.argv) > 1:
        # Extract the command-line argument
        user_input = sys.argv[1]
        print("User input:", user_input)
else:
        print("No command-line argument provided.")

load_dotenv()

client_id = os.getenv("CLIENT_ID")
client_secret = os.getenv("CLIENT_SECRET")
print("Client secret:", client_secret)
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

def search_for_podcast(token, user_key_words):
    sql = "INSERT INTO podcast (Title, Description, Image, URL, Audio, ID) VALUES (%s, %s,%s,%s,%s,%s)"
    if not user_key_words:
        print("Error: No search query provided.")
        return

    url = "https://api.spotify.com/v1/search"
    headers = get_auth_header(token)

    general_key_words = ["black people","black women", "black men", "black girl"]
    combined_user_key_words =  f"{user_key_words.replace(' ', '+')}" if user_key_words else ""
   
    print("General key words:", general_key_words)
    print("Combined user key words:", combined_user_key_words)

    combined_keywords = "+".join(general_key_words) + (f" {combined_user_key_words}")

    # Replace spaces with %20 in the query
    query = f"q={combined_keywords.replace(' ', '+')}&type=episode&limit=40&market=CA"


    query_url = url + "?" + query
    print("Query URL:", query_url)  # Add this line to check the generated query URL

    result = get(query_url, headers=headers)
    print(query_url)
    if result.status_code == 200:
        json_result = result.json()
        for item in json_result.get('episodes', {}).get('items', []):
            # next_page = item.get('next', "")
            name = item.get('name') or 'This podcast has no name :/'
            description = item.get('description', '').capitalize() if 'description' in item else 'No description was provided for this podcast episode, sorry!'
            image_url = item.get('images', [{}])[0].get('url', 'N/A')
            podcast_url = item.get('external_urls', {}).get('spotify', 'N/A')
            episode_id = item.get('id')
            audio = item.get('audio_preview_url') or "No preview was provided but you can listen on Spotify !"
            print("Name:", name)
            print("Image URL:", image_url)
            print("Description:", description)
            print("Podcast URL:", podcast_url)
            print("Episode ID: ", episode_id)
            print("Preview podcast: ", audio)
            # print("Next page: ", next_page)
            print("\n")  
            print("Inserting into the database...")
            cursor.execute("SELECT * FROM podcast WHERE ID = %s", (episode_id,))
            existing_record = cursor.fetchall()     
            print("Existing episodes: ", existing_record)
            connection.commit()
            if not existing_record:
                values = (name, description, image_url, podcast_url, audio, episode_id)
                cursor.execute(sql, values)
                connection.commit()
    else:
        print(f"!Error: {result.status_code} - {result.text}")
search_for_podcast(get_token(), user_input)


@app.route('/search', methods=['POST'])
def search():
    try:
        general_key_words = ["black people","black women", "black men", "black girl"]
        user_key_words = request.form.get('user_key_words', '')
        print("Received user keywords:", user_key_words)
        if not user_key_words:
            return jsonify({"error": "No search query provided"}), 400

        if isinstance(user_key_words, list):
            raw_input = [str(keyword) for keyword in raw_input]

        else:
            raw_input = re.split(r",\s?", user_key_words)
        token = get_token()
        search_for_podcast(token, user_key_words)

        # Commit changes
        connection.commit()
         # Redirect to /search_results.php after processing the form data
       
        return redirect(url_for('results', user_key_words=user_key_words))


    except Exception as e: 
        print(f"Error: {str(e)}")  # Print the error to the console for debugging
        print(f"Type of user_key_words: {type(user_key_words)}")
        print(f"Type of general: {type(general_key_words)}")


        return jsonify({"error": str(e)}), 500
    
@app.route('/results')
def results():
    user_key_words = request.args.get('user_key_words', '')
    # logic for processing user_key_words and rendering the template
    return render_template('index.html', user_key_words=user_key_words)

@app.route('/')
def home():
    return "Welcome to the Flask API!"


   