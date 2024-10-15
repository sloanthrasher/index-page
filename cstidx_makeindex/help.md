#	Help file for CSS variables

Variable names are used to make the code more readable.

This is a listing of the variable names used in the CSS. and the files included in the plugin.

---

## CSS Files included in the plugin:

### Fixed Position CSS files:

* cstidx_bottom_left.css
* cstidx_bottom_right.css
* cstidx_top_left.css
* cstidx_top_right.css

### Floating Position CSS files:

* cstidx_on_left.css
* cstidx_on_right.css

## Variable names used in the CSS files.

### Border values
- --border-color
- --border-width
- --border-style
- --border-radius

### Border colors
- --border-color-primary
- --border-color-secondary

### Background colors
- --background-color-main
- --text-color-bg-item

### Text colors
- --text-color-primary
- --text-color-secondary
- --text-color-item

### Hover colors
- --hover-color-primary
- --hover-color-background

### Visited colors
- --text-color-item-visit
- --background-color-visited

### Additional colors
- --accent-color
  - *used in border and hover styles*
- --text-color-secondary-dark
  - *used in text and border styles*

### Margin values
- --margin-top
- --margin-right
- --margin-bottom
- --margin-left
- --item-margin-top
- --item-margin-right
- --item-margin-bottom
- --item-margin-left

### Padding values
- --padding-small
- --padding-medium
- --padding-large
- --padding-top
- --padding-right
- --padding-bottom
- --padding-left
- --item-padding-top
- --item-padding-right
- --item-padding-bottom
- --item-padding-left
- --item-container-padding-top
- --item-container-padding-right
- --item-container-padding-bottom
- --item-container-padding-left

### Line height values
- --line-height-body
- --line-height-heading
- --line-height-caption
- --line-height-footer

### Index List Width
- --idx-list-max-width

## Selectors used in the CSS files.

| **Selector**                    | **Description**                     |
|---------------------------------|-------------------------------------|
| #cstidx_pg_idx_list           | The main container for the index list |
| #cstidx_pg_idx_list a:visited | "a" tags in the main container for the index list |
| .cstidx-anchor                | Description of this selector        |
| .cstidx-item-1                | Level of the index item. 1 is the top-most level. Has settings for list items at this level. |
| .cstidx-item-1 a              | Level 1 "a" links inside the index item" |
| .cstidx-item-1:visited        | Level 1 "a" visited links inside the index item" |
| .cstidx-item-1:hover          | Level 1 "a" hover links inside the index item" |
| .cstidx-item-2                | Level of the index item. 2 is the second level from the top-most level. Has settings for list items at this level. |
| .cstidx-item-2 a              | Level 2 "a" links inside the index item" |
| .cstidx-item-2:visited        | Level 2 "a" visited links inside the index item" |
| .cstidx-item-2:hover          | Level 2 "a" hover links inside the index item" |
| .cstidx-item-3                | Level of the index item. 3 is the third level from the top-most level. Has settings for list items at this level. |
| .cstidx-item-3 a              | Level 3 "a" links inside the index item" |
| .cstidx-item-3:visited        | Level 3 "a" visited links inside the index item" |
| .cstidx-item-3:hover          | Level 3 "a" hover links inside the index item" |
| .cstidx-item-4                | Level of the index item. 4 is the fourth level from the top-most level. Has settings for list items at this level. |
| .cstidx-item-4 a              | Level 4 "a" links inside the index item" |
| .cstidx-item-4:visited        | Level 4 "a" visited links inside the index item" |
| .cstidx-item-4:hover          | Level 4 "a" hover links inside the index item" |
| .cstidx-item-5                | Level of the index item. 5 is the fifth level from the top-most level. Has settings for list items at this level. |
| .cstidx-item-5 a              | Level 5 "a" links inside the index item" |
| .cstidx-item-5:visited        | Level 5 "a" visited links inside the index item" |
| .cstidx-item-5:hover          | Level 5 "a" hover links inside the index item" |
| .cstidx-item-container        | Div container for each index item |
| .cstidx-item-div              | Div container for each index item |
| .cstidx-item-div:hover        | Hover formatting for the div container for each index item |
| .cstidx-idx-container         | Div container for each index item |
| .cstidx-idx-heading           | Formatting of the list title/heading |
| .cstidx-prefix                | Same as cstidx_anchor |
| .cstidx_pg_idx_list           | Formatting for the list of index items, the div containing the index of pages. |
| .cstidx_pg_idx_list a:visited | Formatting for the list of index items when visited, the div containing the index of pages.|

