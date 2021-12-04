jQuery(document).ready(function($){
    $.ajax({
        url: '/movies/wp-json/actorcall/rest-ajax'
    }).done(function(data){
        console.log(data);

        for (let i = 0; i < 10; i++) {
            console.log(data.results[i]);


            $('#actor-list').append($('<ul class="'+data.results[i].id+'"></ul>'));

            $('#actor-list ul.'+ data.results[i].id +'').append($('<li class="title">' + data.results[i].name + '</li>'));
            $('#actor-list ul.'+ data.results[i].id +'').append($('<img src="https://image.tmdb.org/t/p/w200/' + data.results[i].profile_path +'" alt="' + data.results[i].name + '">'));

        } 

    });

});

