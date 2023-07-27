## Plugins to install

- ACF Pro [link](https://www.advancedcustomfields.com/)
- Yoast SEO [link](https://yoast.com/wordpress/plugins/seo/#utm_content=plugin-info&utm_term=plugin-homepage&shortlink=1uj)
- Classic Editor [link](https://wordpress.org/plugins/classic-editor/)


## After installation

Don't forder to import all ACF settings from the [file](https://github.com/DarPru/wp-template-1/blob/main/acf-export-2021-06-28.json)

1. Open *custom fields*
2. Go to *tools*
3. Choose your file in *Import field group* section
4. Click *import file*

## Author page

You need to setup all nessesary information about the author in  **Users** -> **Edit**

Fields to setup:

- **First Name** and **Last Name** - displays an author name at the front part of the author page
- **Sotial media** - add soital media link to current field to have a linked icon at the front part 

Use the custom part **Additional info** to display the description and author rating

- **Author logo** - dysplays author logo without using Gravatar

## Menus

The theme supports 3 menu sets:

- **Header menu** for header
- **Header submenu** - additional menu for header, place under *Header menu*
- **Footer menu** - menu in footer

## Reviews 

Theme supports custom review block where you can place some product reviews. In includes:

- Custom template for all review pages
- List review template with pagination
- Taxonomy for better filtering
- Banch of snippets for better linking


## Compares

Section where you may compare two popular items to find out witch one is better.  

## Sales

A data type that allows you to post information about discounts and promotions. Supports **Type of sales** taxonomy for better structuring.

## Shortcodes

The theme supports several shortcodes that can be displayed in the keontent:

- **mybtn** - allows you to display a button with an arbitrary link. It accepts *text* and *link* parameters. Example:

````
[mybtn text="This is button" link="#"]
````

- **bigquote** - a block with a complex quote. A specially styled block that accepts the text of the quote - *q_text* - the author's image - *q_img* - his name - *q_name* and job title - *q_job*. Example:

````
[bigquote q_text="Some test" q_img="/link/img.jpg" q_name="Smart Commentor" q_job="The expert"]
````

- **faq** - shortcode with frequently asked questions. To fill this shortcode with content, you need to use ACF repeater. To do this:

1. Call the shortcode **[faq]** in the place where you want to display your accordiotn
2. Fill in the potwotitel with the title **FAQ** at the bottom of the page


