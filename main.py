import phonenumbers
from myphone import number
from phonenumbers import geocoder, carrier
from mapbox import Geocoder

# Parse phone number and get location
pepnumber = phonenumbers.parse(number)
location = geocoder.description_for_number(pepnumber, "en")
print(location)

# Get the carrier information
service_pro = phonenumbers.parse(number)
print(carrier.name_for_number(service_pro, "en"))

# Initialize Mapbox geocoder with your access token
access_token = ''
geocoder = Geocoder(access_token)

# Geocode the location using Mapbox
response = geocoder.forward(location)

# Check for successful geocoding
if response.status_code == 200:
    results = response.json()
    if results['features']:
        print("Mapbox Geocoding Result:", results['features'][0]['place_name'])
    else:
        print("No results found for the location.")
else:
    print("Error with Mapbox geocoding request:", response.status_code)
