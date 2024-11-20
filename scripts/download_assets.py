import os
import requests
from pathlib import Path
import shutil

# Define base directories
BASE_DIR = Path(__file__).parent.parent
IMAGES_DIR = BASE_DIR / "images"
ICONS_DIR = IMAGES_DIR / "icons"
AVATARS_DIR = IMAGES_DIR / "avatars"
BRAND_DIR = IMAGES_DIR / "brand"
EXAMPLES_DIR = IMAGES_DIR / "examples"

# Create directories if they don't exist
for dir_path in [IMAGES_DIR, ICONS_DIR, AVATARS_DIR, BRAND_DIR, EXAMPLES_DIR]:
    dir_path.mkdir(parents=True, exist_ok=True)

# Function to download an image
def download_image(url, save_path):
    try:
        response = requests.get(url, stream=True)
        if response.status_code == 200:
            with open(save_path, 'wb') as f:
                response.raw.decode_content = True
                shutil.copyfileobj(response.raw, f)
            print(f"Downloaded: {save_path}")
        else:
            print(f"Failed to download {url}: Status code {response.status_code}")
    except Exception as e:
        print(f"Error downloading {url}: {str(e)}")

# Icon assets to download (from Feather Icons)
ICONS = {
    # Alert icons
    "alert-circle": "https://raw.githubusercontent.com/feathericons/feather/master/icons/alert-circle.svg",
    "alert-triangle": "https://raw.githubusercontent.com/feathericons/feather/master/icons/alert-triangle.svg",
    "check-circle": "https://raw.githubusercontent.com/feathericons/feather/master/icons/check-circle.svg",
    "info": "https://raw.githubusercontent.com/feathericons/feather/master/icons/info.svg",
    # Navigation icons
    "menu": "https://raw.githubusercontent.com/feathericons/feather/master/icons/menu.svg",
    "x": "https://raw.githubusercontent.com/feathericons/feather/master/icons/x.svg",
    "chevron-right": "https://raw.githubusercontent.com/feathericons/feather/master/icons/chevron-right.svg",
    "chevron-left": "https://raw.githubusercontent.com/feathericons/feather/master/icons/chevron-left.svg",
    "chevron-up": "https://raw.githubusercontent.com/feathericons/feather/master/icons/chevron-up.svg",
    "chevron-down": "https://raw.githubusercontent.com/feathericons/feather/master/icons/chevron-down.svg",
    # User icons
    "user": "https://raw.githubusercontent.com/feathericons/feather/master/icons/user.svg",
    "settings": "https://raw.githubusercontent.com/feathericons/feather/master/icons/settings.svg",
    "bell": "https://raw.githubusercontent.com/feathericons/feather/master/icons/bell.svg",
    "search": "https://raw.githubusercontent.com/feathericons/feather/master/icons/search.svg",
    # Social icons
    "github": "https://raw.githubusercontent.com/feathericons/feather/master/icons/github.svg",
    "twitter": "https://raw.githubusercontent.com/feathericons/feather/master/icons/twitter.svg",
    "facebook": "https://raw.githubusercontent.com/feathericons/feather/master/icons/facebook.svg",
}

# Avatar placeholders from UI Faces (replace with actual URLs when needed)
AVATARS = {
    "avatar-1": "https://i.pravatar.cc/150?img=1",
    "avatar-2": "https://i.pravatar.cc/150?img=2",
    "avatar-3": "https://i.pravatar.cc/150?img=3",
    "avatar-4": "https://i.pravatar.cc/150?img=4",
}

# Example images from Lorem Picsum (reliable placeholder image service)
EXAMPLES = {
    "card-image-1": "https://picsum.photos/800/600?random=1",
    "card-image-2": "https://picsum.photos/800/600?random=2",
    "header-bg": "https://picsum.photos/1920/300?random=3",
}

def main():
    # Download icons
    for icon_name, icon_url in ICONS.items():
        download_image(icon_url, ICONS_DIR / f"{icon_name}.svg")

    # Download avatars
    for avatar_name, avatar_url in AVATARS.items():
        download_image(avatar_url, AVATARS_DIR / f"{avatar_name}.jpg")

    # Download example images
    for example_name, example_url in EXAMPLES.items():
        download_image(example_url, EXAMPLES_DIR / f"{example_name}.jpg")

    print("\nAsset download complete!")
    print(f"\nDownloaded assets to:")
    print(f"Icons: {ICONS_DIR}")
    print(f"Avatars: {AVATARS_DIR}")
    print(f"Examples: {EXAMPLES_DIR}")

if __name__ == "__main__":
    main()
