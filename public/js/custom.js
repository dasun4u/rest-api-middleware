$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploaded_propic').css('background-image', 'url(' + e.target.result + ')');
            //.attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}


