
<!DOCTYPE HTML>
<html>
<style>
    input[type=text],
    select {
        width: 25%;
        padding: 20px 20px;
        margin: 10px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 1px;
        box-sizing: border-box;
        text-align: center;
    }
    
    input[type=submit] {
        width: 25%;
        background-color: rgba(80, 77, 77, 0.13);
        color: black;
        padding: 20px 20px;
        margin: 10px 100;
        border: none;
        border-radius: 1px;
        font-size: large;
        cursor: pointer;
    }
    
    .center {
        margin: auto;
        width: 50%;
        padding: 10px;
        text-align: center;
    }
</style>

<body>
    <div class="center">
        <h1 style="font-size:100%;"> CSV Input </h1>
        <form action="option.php" method="POST">
            Rooms <input type="text" name="rooms" maxlength="80"><br> Schedule <input type="text" name="schedule" maxlength="80"><br>
            <input type="submit">

        </form>
    </div>

</body>

</html>


