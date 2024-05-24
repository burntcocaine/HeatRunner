<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Custom Theme</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
  <link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
  <link rel="stylesheet" href="custom-theme.css">
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <script defer src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
</head>
<body class="custom-theme">
  <header>
    <div class="custom-theme-header">
      <div>Header 1</div>
      <div>Header 2</div>
      <div>Header 3</div>
    </div>
  </header>
  <main>
    <div>
      <div style="width: 33%;">Content 1</div>
      <div style="width: 66%;">Content 2</div>
    </div>
    <section>
      <div>
        <div>Section 1</div>
        <div>Section 2</div>
        <div>Section 3</div>
      </div>
    </section>
    <footer>
      <div class="custom-theme-footer">
        <div>Footer 1</div>
        <div>Footer 2</div>
        <div>Footer 3</div>
      </div>
    </footer>
  </main>
  
  <!-- MDC Buttons -->
  <button class="mdc-button mdc-js-button mdc-button--raised mdc-button--colored custom-theme-secondary-button">MDC Button</button>
  <button class="mdc-button mdc-js-button mdc-button--fab mdc-button--colored custom-theme-secondary-button">MDC Button</button>
  <button class="mdc-button mdc-js-button mdc-button--raised mdc-button--colored custom-theme-secondary-button">MDC Button</button>
  
  <!-- MDL Textfield -->
  <div class="mdl-textfield mdl-js-textfield">
    <input class="mdl-textfield__input" type="text" id="mdl-textfield">
    <label class="mdl-textfield__label" for="mdl-textfield">MDL Textfield</label>
  </div>
</body>
</html>