import json
import mysql.connector
from dotenv import load_dotenv
import os

# Carrega o .env
load_dotenv()

conn = mysql.connector.connect(
    host= os.getenv("DB_HOST"),
    user= os.getenv("DB_USER"),
    password= os.getenv("DB_PASSWORD"),
    database= os.getenv("DB_DATABASE")
)

cursor = conn.cursor()

json_path = os.path.join("..", "json", "achievements.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for achievement_id, achievement in data.items():

    sql = """
    INSERT INTO rail_achievements (
        achievement_id,
        series_id,
        title,
        description,
        hide_desc,
        hide
    )
    VALUES (%s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        series_id = VALUES(series_id),
        title = VALUES(title),
        description = VALUES(description),
        hide_desc = VALUES(hide_desc),
        hide = VALUES(hide)
    """

    values = (
        int(achievement["id"]),
        int(achievement["series_id"]),
        achievement["title"],
        achievement["desc"],
        achievement["hide_desc"],
        achievement["hide"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")