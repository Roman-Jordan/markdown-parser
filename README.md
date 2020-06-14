# Markdown Parser
A simple self dependent Mark Down parser that conforms to GFM or Git Hub Flavored Mark Down

## Getting Started
Depending on what language you are using and if you would like this to be handeled clinet side or server side, you can simply add your desired language to your project. Want to add your own rule? You can simply extend the class or add your rule to the parent class. All rules should be prefixed with `rule_`, this allows them to auto load. 

### Available Rules

1. ```rule_headings:``` If a line starts with `#` and has a space before the proceeding text, the system will count all of your hashtags and replacing them with the appropriate `<h[1-#]>` tag and adding the same tag to the end of that line.