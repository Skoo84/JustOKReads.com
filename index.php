<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include("config.php");?>
<title>Just OK Reads</title>
<link rel="stylesheet" href="navbar.css">
<?php include('navbar.php'); ?>
<body>

<div class="main2">

</div>

<br>

<div class="main3">

    <div class = "container">
        <article class = "row">
            <section class = "col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-header"></div>
                        <h6>Reading challenge: Choose a title from a specific author, read it and give a review.
                            <br>
                            This month's titles belongs to Eric-Emmanuel Schmith</h6>
                    </div>
                    <img src="https://filme-carti.ro/wp-content/uploads/2018/10/Lansare_Eric_Emmanuel_Schmitt_cover.jpg" width="100%">
                </div>
            </section>
            <aside class="col-lg-4">
                <form class="panel-group form-horizontal" role="form">
                    <div class = "panel panel-default">
                        <div class = "panel-heading"> Suggest a new title for the next month </div>
                        <br>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="title" class="control-label col-sm-4"> Title </label>
                                <div class="col-sm-12">
                                    <input type="text" id="title" placeholder="book title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="publisher" class="control-label col-sm-4"> Publisher </label>
                                <div class="col-sm-12">
                                    <input type="text" id="publisher" placeholder="publisher's name" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="releaseDate" class="control-label col-sm-4"> Release date </label>
                                <div class="col-sm-12">
                                    <input type="text" id="releaseDate" placeholder="Release Date" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label col-sm-4"> Short description</label>
                                <div class="col-sm-12">
                                    <input type="text" id="description" placeholder="Short Description" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-sm-12">
                                    <input type="submit" id="description" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </aside>
        </article>
    </div>


</div>

</body>
</html>