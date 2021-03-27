@extends('layout/admin_dashboard')
@extends('layout/details')
@section('inner_block')
<div class="header">
    <h2>New Paper</h2>
</div>
<div class="row" style=" position: fixed;">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <form class="form-group" method="post" action="new paper validater.php" style="margin-left: 5%">
        <div class="col-lg-4">
            <label>paper name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="papername" type="text" name="papername">
        </div>
        <div class="col-lg-4">
            <label>Numer of Questions</label>
            <input id="NOQ" type="number" name="NOQ">
        </div>
        <div class="col-lg-4">
            <label>Total Time(min)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="TT" type="munber" name="TT">
        </div>
        <h4>PHYSICS</h4>
        <div class="col-lg-4">
            <label>Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="PQ" type="number" name="PQ">
        </div>
        <div class="col-lg-4">
            <label>Question Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="PM" type="number" name="PM">
        </div>
        <div class="col-lg-4">
            <label>Negative Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="PN" type="number" name="PN">
        </div>
        <h4>CHEMISTRY</h4>
        <div class="col-lg-4">
            <label>Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="CQ" type="number" name="CQ">
        </div>
        <div class="col-lg-4">
            <label>Question Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="CM" type="number" name="CM">
        </div>
        <div class="col-lg-4">
            <label>Negative Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="CN" type="number" name="CN">
        </div>
        <h4>MATHMATICS</h4>
        <div class="col-lg-4">
            <label>Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="MQ" type="number" name="MQ">
        </div>
        <div class="col-lg-4">
            <label>Question Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="MM" type="number" name="MM">
        </div>
        <div class="col-lg-4">
            <label>Negative Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="MN" type="number" name="MN">
        </div>
        <h4>BIOLOGY</h4>
        <div class="col-lg-4">
            <label>Questions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="BQ" type="number" name="BQ">
        </div>
        <div class="col-lg-4">
            <label>Question Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="BM" type="number" name="BM">
        </div>
        <div class="col-lg-4">
            <label>Negative Mark&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input id="BN" type="number" name="BN">
        </div>
        <div class="col-md-11" style="margin-top: 30px;">
            <button id="submit" type="submit" name="submit" value="submit" style="background-color: #fd6e70" class="btn btn-block ">SUBMIT</button>
        </div>
    </form>
</div>
</div>
<style type="text/css">
.header h2 {
    margin-left: 40%;
    color: #4f4f4f;
    padding-top: 4%;
    font-family: 'Arial Black', Gadget, sans-serif;
    margin-bottom: 20px;
}

h4 {
    margin-left: 2%;
    color: mediumseagreen;
    padding-top: 3%;
    padding-bottom: 0.5%;
    font-family: 'Arial Black', Gadget, sans-serif;
    margin-bottom: 5px;
}

</style>
</div>
</div>
@endsection
