Create a new ACF block in this WordPress theme.

1. Ask the user for:
   - Block name (e.g. "Call to Action") — derive the slug by lowercasing and replacing spaces with hyphens (e.g. "call-to-action")
   - ACF fields: for each field, collect its label, name (snake_case), and type. Supported types: text, textarea, wysiwyg, link, image, true_false, select, repeater. Keep asking until the user says they're done.

2. Generate these four files:

**blocks/{slug}/block.json**
```json
{
    "name": "acf/{slug}",
    "title": "{Title}",
    "description": "",
    "category": "custom-blocks",
    "icon": "admin-generic",
    "keywords": [],
    "acf": {
        "blockVersion": 3,
        "mode": "preview",
        "renderTemplate": "{slug}.php"
    },
    "align": "full"
}
```

**blocks/{slug}/{slug}.php**
- Start with `<?php` then declare variables using `get_field()` for each field
- Wrap everything in `<section class="block {slug}"><div class="container">...</div></section>`
- For each field, wrap in `<?php if ($field_name) : ?>` / `<?php endif; ?>`
- Escaping rules by type:
  - text: `esc_html($var)`
  - textarea: `wp_kses_post($var)` (outputs with wpautop formatting)
  - wysiwyg: `echo wp_kses_post($var)` (ACF does not sanitise WYSIWYG output)
  - link: `esc_url($var['url'])`, `esc_html($var['title'])`, `esc_attr($var['target'])` — link fields return arrays; render as `<a>` with a null-safe target check
  - image: render as `<img>` using `$var['url']`, `$var['alt']`, `$var['width']`, `$var['height']`
  - true_false: use as a boolean condition only, no output
  - select: `esc_html($var)`

**blocks/{slug}/{slug}.scss**
- BEM scaffold: one rule per field as a `__{element}` child of `.{slug}`
- `.{slug}` block with `padding-top/bottom: var(--spacing-xl)`
- Leave child rules empty — just the selectors as placeholders

**acf-json/group_{hex}.json**
- Generate a unique group key: `group_` + current Unix timestamp as 8-char hex
- Generate unique field keys: same hex base + sequential 5-digit suffix (e.g. `field_6808a88000001`, `field_6808a88000002`)
- Set `"modified"` to the current Unix timestamp (decimal)
- Location rule: `"param": "block"`, `"operator": "=="`, `"value": "acf\/{slug}"`
- Field type-specific properties:
  - text: include `"default_value": "", "maxlength": "", "placeholder": ""`
  - textarea: include `"default_value": "", "new_lines": "wpautop", "rows": ""`
  - wysiwyg: include `"default_value": "", "tabs": "all", "toolbar": "basic", "media_upload": 0, "delay": 0`
  - link: include `"return_format": "array"`
  - image: include `"return_format": "array", "preview_size": "medium"`
  - true_false: include `"default_value": 0, "ui": 1`
  - select: include `"choices": {}, "default_value": "", "return_format": "value", "multiple": 0, "allow_null": 0, "ui": 0`

3. SCSS does not need a manual import — `styles.scss` and `editor-style.scss` already use `@import "../../blocks/*/*.scss"` which picks it up automatically.

4. After creating all files, remind the user to go to ACF → Field Groups in WordPress and sync the new group before using the block in the editor.

Use the existing blocks in this project as reference:
- `blocks/accordion/` — repeater fields, true_false, complex PHP template
- `blocks/page-header/` — text, textarea, link fields, simple layout
