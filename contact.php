<?php
include ('assets/core/header.php');
?>
<main>
    <form>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Uw naam</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Doe">
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="email" class="form-control" placeholder="name@example.com" aria-label="Email"
                aria-describedby="basic-addon1">
        </div>

        <!-- <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">📞</span>
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">Dropdown</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            <input type="text" class="form-control" aria-label="Text input with dropdown button">
        </div> -->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">+31</span>
            <input type="text" class="form-control" placeholder="0 6 00 00 00 00" aria-label="tel"
                aria-describedby="basic-addon1">
        </div>
    </form>
</main>