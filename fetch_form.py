import urllib.request
import re

url = 'https://forms.gle/nSrUJS9wSP5ieoNNA'
try:
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    response = urllib.request.urlopen(req)
    html = response.read().decode('utf-8')
    
    # Extract action URL
    action_match = re.search(r'action="(https://docs\.google\.com/forms/[^"]+formResponse)"', html)
    if action_match:
        print("Action URL:", action_match.group(1))
    else:
        print("Action URL not found")
        
    # Extract all entry IDs and surrounding text to guess labels
    # Google form fields usually look like: name="entry.123456"
    entries = set(re.findall(r'name="(entry\.\d+)"', html))
    print("Entries found:", entries)
    
    # Let's try to extract the fbzx value, required for form submission
    fbzx_match = re.search(r'name="fbzx" value="([^"]+)"', html)
    if fbzx_match:
        print("fbzx:", fbzx_match.group(1))
    
    # Try to find the labels related to entries by parsing FB_PUBLIC_LOAD_DATA_
    data_match = re.search(r'var FB_PUBLIC_LOAD_DATA_ = (\[.*?\]);', html, re.DOTALL)
    if data_match:
        data = data_match.group(1)
        for entry in entries:
            entry_id = entry.split('.')[1]
            # find label text around this ID in the JSON array
            idx = data.find(entry_id)
            if idx != -1:
                start = max(0, idx - 100)
                end = min(len(data), idx + 100)
                print(f"Label context for {entry}:", data[start:end])
                
except Exception as e:
    print("Error:", e)
