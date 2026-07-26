import urllib.request
import re
import json

url = 'https://docs.google.com/forms/d/e/1FAIpQLSeDICgltd90k_PIB4NmBqb0GSCvcmBD0pOluN0J9Ubt6zqtVA/viewform'
try:
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    response = urllib.request.urlopen(req)
    html = response.read().decode('utf-8')
    
    data_match = re.search(r'var FB_PUBLIC_LOAD_DATA_ = (\[.*?\]);', html, re.DOTALL)
    if data_match:
        data_str = data_match.group(1)
        data = json.loads(data_str)
        # Form metadata is in data[1]
        fields = data[1][1]
        for field in fields:
            title = field[1]
            if field[4]:
                entry_ids = [str(x[0]) for x in field[4]]
                print(f"Title: {title}, entry IDs: {entry_ids}")
except Exception as e:
    print("Error:", e)
