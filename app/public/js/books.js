const Book = {
    data() {
      return {
        "books": [],
        "students": [],
        "offers": [],
        "selectedStudent": null,
        "bookForm": {},
        "selectedBook": null 
      }
    },

    methods: {
        fetchBookData() {
            fetch('/api/books/')
            .then(response => response.json())
            .then((parsedJson) => {
                console.log(parsedJson);
                this.books = parsedJson
            })
            .catch( (err) => {
                console.error(err);
            });
        },

        postBook(evt) {
            if (this.selectedBook === null) {
                this.postNewBook(evt);

            } else {
                this.postEditBook(evt);
            }
        },
        postNewBook(evt) {
            console.log("Creating!", this.bookForm);
            alert("Created!");

        fetch('api/books/create.php',{
            method:'POST',
            body: JSON.stringify(this.bookForm),
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            }
        })
        .then( response => response.json() )
        .then( json => {
            console.log("Returned from post:", json);
            this.books = json;
            this.resetBookForm = {};
        });
    },
    
        postEditBook(evt) {
            this.bookForm.bookId = this.selectedBook.Id;
            this.bookForm.id = this.selectedBook.id;
            console.log("Updating!", this.bookForm);
            alert("Updated!");

        fetch('api/books/update.php',{
            method:'POST',
            body: JSON.stringify(this.bookForm),
            headers: {
                "Content-Type": "application/json; charset=utf-8"
    }
})
        .then( response => response.json() )
        .then( json => {
            console.log("Returned from post:", json);
            this.books = json;
            this.resetBookForm = {};
        });
    },

        postDeleteBook(o) {
           if ( !confirm("Are you sure you want to delete the offer from " + o.title +"?") ) {
                return;
            }
            console.log("Delete!", o);

        fetch('api/books/delete.php',{
            method:'POST',
            body: JSON.stringify(o),
            headers: {
                "Content-Type": "application/json; charset=utf-8"
        }
    })
        .then( response => response.json() )
        .then( json => {
            console.log("Returned from post:", json);
            this.books = json;
            this.resetBookForm = {};
        });
    },
        selectBookToEdit(b) {
        this.selectedBook = b;
        this.bookForm = Object.assign({}, this.selectedBook);
    },
        resetBookForm() {
        this.selectedBook = null;
        this.bookForm = {};
  }
},
    created() {
        this.fetchBookData ();
    } //end created
} // end Offer config

Vue.createApp(Book).mount('#books');