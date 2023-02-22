<?php 
    $link = mysqli_connect("localhost", "root", "", "world");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Dropdown</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-4 mt-4">
                Country <select id="countryId" class="form-select">
                            <option hidden>Select</option>
                            <?php 
                                $sel = mysqli_query($link, "select * from countries");
                                while($arr = mysqli_fetch_assoc($sel)){
                                    ?>
                                        <option value="<?=$arr['id']?>"><?=$arr['name']?></option>
                                    <?php
                                }
                            ?>
                         </select>
            </div>
            <div class="col-4 mt-4" id="stateId">
                State <select id="stateSelectId" aria-label="Default select example" class="form-select">
                    
                </select>
            </div>
            <div class="col-4 mt-4" id="cityId">
                City <select id="citySelectId" aria-label="Default select example" class="form-select">
                    
                </select>
            </div>
        </div>
    </div>
    
    <script>
       $(document).ready(function() {

            $('#stateId').hide();
            $('#cityId').hide();

            $('#countryId').change(function(){

                var stateId = $(this).val();

                $.get('api.php', {stateId:stateId},function(res){

                    dData = JSON.parse(res);
                    allData = dData.data;
                    
                    options = `<option hidden>Select</option>`;
                    allData.forEach(e => {
                        options += `<option value='${e.id}'>${e.name}</option>`;
                    })

                    $('#stateSelectId').html(options)
                    $('#stateId').show(options);
                    $('#cityId').hide();
                });
               
            })

            $('#stateSelectId').change(function(){

                var cityId = $(this).val();
                console.log(cityId);

                $.get('api.php', {cityId:cityId},function(resp){ 

                    dData = JSON.parse(resp);
                    console.log(dData);
                    allData = dData.data;
                    
                    options = `<option hidden>Select</option>`;
                    allData.forEach(e => {
                        options += `<option value="${e.id}">${e.name}</option>`;
                    })

                    $('#citySelectId').html(options)
                    $('#cityId').show();
                });

                })

       })
    </script>
</body>
</html>