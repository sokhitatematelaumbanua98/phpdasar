$(document).ready(function(){

    //menghilangkan tombol cari
$('#tombolcari').hide();



//ivent ketika keyword di tulis

$('#keyword').on('keyup', function(){

    // untuk tombol cari
    $('.loader').show();

    //ajax menngunakan load
    
    $.get('ajax/databarangmasuk.php?keyword=' + $('#keyword').val(), function(data) {

        $('#container').html(data);
        $('.loader').hide();
    });

// // untuk input data
// $('#container').load('ajax/databarangmasuk.php?keyword=' + $('#keyword').val())

})

});



function myFunctions(){
    let a = document.getElementById("password");
    let b = document.getElementById("hide1");
    let c = document.getElementById("hide2");
    if(a.type === 'password'){
        a.type = "text"
        b.style.display = "block";
        c.style.display = "none";
    }else{
        a.type = "password"
        b.style.display = "none";
        c.style.display = "block";
    }

}


function myFunction(){
    let x = document.getElementById("password2");
    let y = document.getElementById("hide1");
    let z = document.getElementById("hide2");
    if(x.type === 'password'){
        x.type = "text"
        y.style.display = "block";
        z.style.display = "none";
    }else{
        x.type = "password"
        y.style.display = "none";
        z.style.display = "block";
    }

}



// console.log("hello");



// let keyword = document.getElementById('keyword');

// let tombolcari = document.getElementById('tombolcari');

// let container = document.getElementById('container');

// // tambahkan iven ketika di tulis
// keyword.addEventListener('keyup', function(){
//   //membuat object ajx

//   let ajax = new XMLHttpRequest();

//   //MENGECEK KESIAPAN AJAXNYA SIAPA DI GUNAKAN 

//   ajax.onreadystatechange = function(){

//     if(ajax.readyState == 4 && ajax.status == 200){
//      container.innerHTML = ajax.responseText;
//     }
//   }
//     ajax.open('GET', 'ajax/databarangmasuk.php?keyword=' + keyword.value, true);
//     ajax.send();

// });
