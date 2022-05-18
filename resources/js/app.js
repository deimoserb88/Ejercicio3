const app = {

    routes : {
        inisesion :"/resources/views/auth/login.php",
        login : "/app/app.php",
        logout :"/app/app.php?_logout",
        newpost : "/resources/views/newpost.php",
        prevposts :"/app/app.php?_pp",
        lastpost :"/app/app.php?_lp",
    },
    pp : $("#prev-posts"),
    lp : $("#content"),
    view : function(route){
        location.replace(app.routes[route]);
    },

    previousPosts : function(){
        let html = `<b>Aún no hay publicaciones en este Blog</b>`;
        this.pp.html("");
        fetch(this.routes.prevposts)
            .then( response => response.json())
            .then( ppresp => {
                if( ppresp.length > 0){
                    html = "";
                    let primera = true;
                    for( let post of ppresp ){
                        html += `
                            <a href="#" onclick="app.openPost(event,${ post.id },this)"
                                class="list-group-item list-group-item-action ${ primera ? `active` : `` } pplg">
                                <div class="w-100 border-bottom">
                                    <h5 class="mb-1">${ post.title }</h5>
                                    <small class="text-${ primera ? `light` : `muted` }">
                                        <i class="bi bi-calendar-week"></i>
                                        ${ post.fecha }
                                    </small>
                                </div>
                                <p class="mb-1">${ post.body.substr(1,100)}...</p>
                                    <small>
                                        <i class="bi bi-person-circle"></i>
                                        <b>${ post.name }</b>
                                    </small>
                                </a>
                        `;
                        primera = false;
                    }
                    this.pp.html(html);
                }
            }).catch( err => console.error( err ));
    },


    lastPost : function(limit){
        let html = "<h2>Aún no hay publicaciones</h2>";
        this.lp.html("");
        fetch(this.routes.lastpost + "&limit=" + limit)
            .then( response => response.json())
            .then( lpresp => {
                if( lpresp.length > 0){
                    html = `
                        <div class="w-100 border-bottom">
                            <h5 class="mb-1">${ lpresp[0].title }</h5>
                            <small class="text-muted">
                                <i class="bi bi-calendar-week"></i>${ lpresp[0].fecha } |
                                <i class="bi bi-person-circle"></i><b>${ lpresp[0].name }</b>
                            </small>
                        </div>
                        <p class="mb-1">${ lpresp[0].body }</p>
                    `;
                }
                this.lp.html(html);
            }).catch( err => console.error( err ));

    }

   

} ;