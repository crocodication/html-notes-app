<html>
  <head>
    <title>
      Notes App
    </title>

    <link rel="stylesheet" href="./sources/styles.css">

    <script src="./sources/actions.js"></script>
  </head>

  <body>
    <div
      class="page-container"
    >
      <h1
        class="title"
      >
        Notes App
      </h1>
      
      <div
        class="notes-list"
        id="notes-list"
      >
      
      </div>

      <div
        class="bottom-options-container"
      >
        <a
          class="create-new-note"
          href="#"
          onclick="createNewNote()"
        >
          Create New Note
        </a>

        <div
          id="submit-button-container"
        >
        </div>
      </div>
    </div>

    <div
      class="loader-container"
      id="loader-container"
    >
    </div>
  </body>
</html>