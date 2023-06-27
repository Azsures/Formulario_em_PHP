import re

def extract_label_for_values(file_path):
    with open(file_path, 'r') as file:
        content = file.read()

    regex = r'<label\s+for\s*=\s*["\']([^"\']+)["\']\s*>'
    matches = re.findall(regex, content)

    return matches

# Example usage:
cont = 1
file_path = 'find.txt'  # Replace with the path to your text file
label_for_values = extract_label_for_values(file_path)
for element in label_for_values:
    print(f'$opiniao{cont} = $_POST["{element}"];')
    cont += 1
cont = 1
for element in label_for_values:
    print(f'$opiniao{cont} . "," .')
    cont += 1
