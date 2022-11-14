tpe2_web2

movies
Method      Url                 Code    Action
GET         api/movies          200     devuelve un arreglo de peliculas (paginado, 6 items/pagina max)
                                            parametros
                                            sort    opcional    campo por el cual se quiere ordenar
                                            order   opcional    orden por el cual se quiere ordenar asc o desc (por defecto asc)
                                            genre   opcional    genero por el cual se quiere filtrar, debe ser un id
                                            page    opcional    numero de pagina (por defecto 1)   
GET         api/movies/:id      200     devuelve info de una pelicula especifica
POST        api/movies          201     agrega una pelicula
PUT         api/movies/:id      200     edita una pelicula especifica
DELETE      api/movies/:id      200     elimina una pelicula especifica

directors
GET         api/directors       200     devuelve arreglo de directores
GET         api/directors/:id   200     devuelve info de un director
POST        api/directors       201     agrega un director
PUT         api/directors/:id   200     edita un director
DELETE      api/directors/:id   200     elimina un director

genres
GET         api/genres          200     devuelve arreglo de generos
GET         api/genres/:id      200     devuelve info de un genero
POST        api/genres          201     agrega un genero
PUT         api/genres/:id      200     edita un genero
DELETE      api/genres/:id      200     elimina un genero