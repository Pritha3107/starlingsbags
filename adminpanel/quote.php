<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="https://kit.fontawesome.com/398c77c1ca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="assets/Coloris-main/dist/coloris.js"></script>
    <link rel="stylesheet" href="assets/Coloris-main/dist/coloris.css">
    <link rel="stylesheet" href="./quote.css">
    <title>QUOTE</title>
</head>

<body>
    <?php include("header.php");
    $quoteType=$_GET['quoteType'];
    ?>
    <div class="body">

        <div class="get_quote">

            <div class="form_content">

                <div class="text-center mb-5">
                    <h3 class="pt-4">Get A Quote</h3>
                    <p class="mt-3">Click the "Customize" button to add new quote input</p>
                </div>

                <form action="" onsubmit="validateform()" novalidate class="d-flex flex-wrap justify-content-center">
                    <input type="hidden" id="quotetypeId" name="quoteType" value="<?=$quoteType?>" />
                    <div style="width: 100%;" class="m-3">
                        <div class="h5 text-center pb-2 mt-4 mb-4">Add More Option</div>
                        <div id="checkBoxContainer" class="d-flex justify-content-center pt-3 flex-wrap"></div>
                        <div class="color_option">
                            <label for="">SELECT COLOR</label> <br>
                            <div class="multiple_color">
                                <div class="example circle">
                                    <div class="clr-field" style="color:#000">
                                        <button type="button"></button>
                                        <input type="text" class="coloris instance2" value="#000">
                                    </div>
                                </div>
                            </div>
                            <div class="add_clr pt-2 pb-2">
                                <i class="fa-solid fa-minus"></i>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div id="cusInput"></div>
                        <div class="text-center">
                            <button class="btn btn-success shadow-none" type="button" id="customize">Customize</button>
                        </div>
                        <div class="d-none justify-content-center p-3 bg-light shadow-sm mb-3 addInputParentContainer">
                            <div class="addInputTagContainer w-100 text-center ">
                                <!-- <label for="inputLabel"></label> -->
                                <input type="text" class="my-2 form-control shadow-none" id="inputLabel"
                                    placeholder="Ex: Fabric">
                                <small class="d-none text-start text-danger" id="invalidText"></small>
                                <input type="radio" class="ms-2 d-none selected-input" name="inputTypeChoose"
                                    value="text" id="textInput" checked>
                                <label class="selected-label px-3 py-1 fs-6" for="textInput">Text</label>
                                <input type="radio" class="ms-2 d-none selected-input" name="inputTypeChoose"
                                    value="number" id="number">
                                <label class="selected-label px-3 py-1 fs-6" for="number">Number</label>
                                <input type="radio" class="ms-2 d-none selected-input" name="inputTypeChoose"
                                    value="checkbox" id="checkBox">
                                <label class="selected-label px-3 py-1 fs-6" for="checkBox">check Box</label>
                                <input type="radio" class="ms-2 d-none selected-input" name="inputTypeChoose"
                                    value="select" id="select">
                                <label class="selected-label px-3 py-1 fs-6" for="select">Select</label>
                                <!-- <input type="radio" class="ms-2" name="inputTypeChoose" value="checkbox" id="color">
                                <label for="color">color</label> -->
                                <div
                                    class="d-flex d-none flex-wrap justify-content-center align-items-center optionTagsContainer">
                                    <input type="number" id="numberOfLength" class="w-25 my-3 form-control shadow-none"
                                        placeholder="Ex.(5)">
                                    <div><button type="button" id="numberOfLengthAddBtn"
                                            class="m-2 btn shadow-none bg-danger px-2 py-0 text-white">+</button></div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-center" id="choosetagValueGet">

                                </div>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-secondary shadow-none" name="inputTypeChoose" type="button"
                                        id="closeBtn">Close</button>
                                    <button class="btn btn-success shadow-none" name="inputTypeChoose" id="creInput"
                                        type="button">Create Element</button>
                                </div>
                            </div>
                            <div class="optionContainer d-none">
                                <h5 class="text-center labelName"></h5>
                                <div
                                    class="d-flex flex-wrap justify-content-center align-items-center optionsContainer">
                                </div>
                                <div class="d-flex align-items-center mt-2"><input type="text" id="addOptionInput"
                                        class="form-control shadow-none">
                                    <button type="button" class="btn shadow-none  bg-success text-white fs-6 ms-1"
                                        id="OptionInputAddBtn">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap w-100">
                            <button type="button" class="btn bk btn-outline-danger my-2"
                                onclick="location.reload()">Clear</button>
                            <button type="button" class="btn btn-outline-success shadow-none my-2" id="saveChanges"
                                disabled>Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>

</body>

</html>
<script src="https://unpkg.com/jquery@3.6.0/dist/jquery.min.js"></script>

<script>
// let formstrure;
$(document).ready(function() {
    // var formstrure;
    console.log(inputGroups);
    // fetchFormData();
    // console.log(quoteFormStructure);
    $(document).on('click', '#saveChanges', function(e) {
        e.preventDefault();
        //var structureArray = 'inputdata';
        //console.log('hi');
        // console.log(inputGroups);
        //quoteFormStructure = inputGroups;
        // const quoteFormStructure = inputGroups;
        // console.log(quoteFormStructure);
        if (inputGroups.length == 0) {

            var inputGroupsArray = '';
        } else {
            var inputGroupsArray = inputGroups;
        }
        // console.log(inputGroupsArray);
        $.ajax({
            url: 'product-controller.php',
            method: 'POST',
            data: {
                ajaxaction: 'quoteFormStructure',
                formdata: inputGroupsArray,
                quotetype: $('#quotetypeId').val()
            },
            success: function(response) {
                // console.log(response);
                if (!response) {
                    alert('somthing went to wrong');
                } else {
                    alert('Your changes has been saved successfully..!');
                }
            }
        });
        // alert('form is filled');

    });

});


// fetchFormData();
</script>
<script src="quote.js"></script>