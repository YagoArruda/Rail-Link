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

json_path = os.path.join("..", "json", "relic_sets.json")

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

for relic_set_id, relic_set in data.items():

    sql = """
    INSERT INTO relic_sets (
        relic_set_id,
        name,
        effect_2pc,
        effect_4pc,
        properties,
        icon
    )
    VALUES (%s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        name = VALUES(name),
        effect_2pc = VALUES(effect_2pc),
        effect_4pc = VALUES(effect_4pc),
        properties = VALUES(properties),
        icon = VALUES(icon)
    """

    values = (
        int(relic_set["id"]),
        relic_set["name"],
        relic_set["desc"][0] if len(relic_set["desc"]) > 0 else None,
        relic_set["desc"][1] if len(relic_set["desc"]) > 1 else None,
        json.dumps(relic_set["properties"]),
        relic_set["icon"]
    )

    cursor.execute(sql, values)

conn.commit()
cursor.close()
conn.close()

print("Importação concluída!")