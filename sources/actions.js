const baseURL = './sources/api'
const useURLExtension = location.hostname === 'localhost' || location.hostname === '127.0.0.1' ? '.php' : ''

let notes = []

window.onload = () => {
  for(let i = 0; i < 15; i++) {
    notes.push({
      id: i,
      text_value: 'Test ini contoh catatan'
    })
  }

  rerenderNotes()

  return
  rerenderLoader(true)

  fetch(
    `${baseURL}/get-notes${useURLExtension}?owner_id=${999}`
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    console.error(err.toString())
  })
}

const createNewNote = () => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/create-new-note${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        owner_id: 999
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)

    console.error(err.toString())
  })
}

const deleteButton = id => {
  rerenderLoader(true)

  fetch(
    `${baseURL}/delete-note${useURLExtension}`,
    {
      method: 'POST',
      body: JSON.stringify({
        id
      })
    }
  )
  .then(res => res.text())
  .then(resText => {
    rerenderLoader(false)

    if(resText[0] == "{") {
      const resJSON = JSON.parse(resText)

      notes = resJSON['data']

      rerenderNotes()
    } else {
      console.error(resText)
    }
  })
  .catch(err => {
    rerenderLoader(false)
    
    console.log(err.toString())
  })

  rerenderNotes()
}

const rerenderNotes = () => {
  document.getElementById("notes-list").innerHTML = ''
  
  for(const note of notes) {
    document.getElementById("notes-list").innerHTML += `
      <div
        class="note-container"
      >
        <input
          class="note"
          id="note-${note.id}"
          name="notes[]"
          placeholder="Insert note..."
          type="text"
          value="${note.text_value}"
        >

        <a
          class="delete-button"
          href="#"
          onclick="deleteButton('${note.id}')"
        >
          X
        </a>
      </div>
    `
  }

  for(const note of notes) {
    const input = document.getElementById(`note-${note.id}`)
  
    input.addEventListener('input', event => {
      note.text_value = event.target.value
      
      fetch(
        `${baseURL}/edit-note${useURLExtension}`,
        {
          method: 'POST',
          body: JSON.stringify({
            id: note.id,
            text_value: event.target.value
          })
        }
      )
      .then(res => res.text())
      .then(resText => {})
      .catch(err => console.log(err.toString()))
    })
  }
}

const rerenderLoader = (isLoading) => {
  document.getElementById('loader-container').innerHTML = isLoading ?
    `<div class="loader-background">
        <div class="loader"></div>
    </div>`
    :
    ``
}