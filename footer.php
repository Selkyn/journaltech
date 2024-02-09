<footer>
    <p>Je suis un footer</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="//code.jquery.com/ui/jquery-1.12.1/jquery-ui.js"></script> -->
<!-- <script>
    $(document).ready(function() {
        $('#search-user').keyup(function() {
            $('#result-search').html('');
            // alert('ok');
            let utilisateur = $(this).val();
            if(utilisateur != "") {
                $.ajax({
                    type:'GET',
                    url: 'index.php',
                    data: 'user=' + encodeURIComponent(utilisateur),
                    success: function(data){
                        if(data !="") {
                            $('#result-search').append(data);
                        }else {
                            document.getElementById('resultat-search').innerHTML = "<div style ='font-size: 20px; text-align: center; margin-top: 10px'>Rien trouvé</div>"
                        }
                    }
                })
            }
            console.log(user);
        });
    });
</script> -->
</body>
</html>