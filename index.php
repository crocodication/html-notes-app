<html>
  <head>
    <title>
      Notes App
    </title>

    <link rel="stylesheet" href="./styles.css">

    <script src="./actions.js"></script>

    <script>
      const id = localStorage.getItem('id')

      if(id == undefined) {
        redirect(`/login`)
      }

      window.onload = () => {
        loadNotes()
      }
    </script>
  </head>

  <body>
    <div
      class="page-container"
    >
      <p
        class="title"
      >
        Notes App
      </p>
      
      <div
        class="content-container"
        id="notes-list"
      >
      </div>

      <div
        class="bottom-options-container"
      >
        <a
          class="bottom-option"
          href="#"
          onclick="redirect('/delete-account')"
        >
          Delete Account
        </a>

        <a
          class="bottom-option"
          href="#"
          onclick="logout()"
        >
          Logout
        </a>

        <a
          class="bottom-option"
          href="#"
          onclick="createNewNote()"
        >
          Create New Note
        </a>
      </div>
    </div>

    <div
      class="loader-container"
      id="loader-container"
    >
    </div>
  </body>
</html>