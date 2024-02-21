<?php include('layouts/header.php') ?>

<style>
    /* CSS styles */
    .sliding-container {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .box-container {
        margin-top: 25px;
        display: flex;
        transition: transform 0.5s ease;
    }

    .box {
        flex: 0 0 100%;
        height: 300px;
        position: relative;
        overflow: hidden;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        /* Added for card design */
        border: 1px solid #ddd;
        transition: box-shadow .3s;
    }

    .box:hover {
        box-shadow: 0 0 11px rgba(33, 33, 33, .2);
    }

    .box1-content {
        text-align: center;
        color: #222;
    }

    .box1-content h1 {
        font-family: 'Arial', sans-serif;
        color: #222;
        /* Changed to black for better readability */
        font-size: 36px;
        font-weight: bold;
        margin-top: 50px;
        margin-bottom: 10px;
    }

    .box1-content p {
        font-family: 'Arial', sans-serif;
        color: #222;
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .circles {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .circle {
        width: 10px;
        height: 10px;
        background-color: #222;
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .active {
        background-color: orange;
    }

    .decoration {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.3;
        z-index: 0;
    }
</style>


<div class="sliding-container">
    <div class="box-container">
        <div class="box active">
            <div class="decoration"></div>
            <div class="box1-content">
                <h1>Welcome to Our Website</h1>
                <p>It's a Step to Revolutionize</p>
                <p>Taking Shop Online </p>
            </div>
        </div>
        <div class="box">Box 2</div>
        <div class="box">Box 3</div>
    </div>
</div>

<div class="circles">
    <div class="circle active"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div style="margin: auto;" class="separator"></div>

<section>
    <div id="product1" class="p-1">
        <div class="pro-container">

            <div class="pro">
                <img src="" alt="">
                <div class="pro-content">
                    Monthly Grocery list
                </div>
            </div>
        </div>
            <div class="pro">
                <img src="" alt="">
                <div class="pro-content">
                    fast-food-items
                </div>
            </div>
        </div>

    </div>

</section>



<script>
    // JavaScript code
    const boxContainer = document.querySelector('.box-container');
    const circles = document.querySelectorAll('.circle');
    let activeIndex = 0;

    circles.forEach((circle, index) => {
        circle.addEventListener('click', () => {
            setActive(index);
        });
    });

    function setActive(index) {
        activeIndex = index;
        updateSlider();
    }

    function updateSlider() {
        const offset = -activeIndex * 100;
        boxContainer.style.transform = `translateX(${offset}%)`;
        circles.forEach((circle, index) => {
            if (index === activeIndex) {
                circle.classList.add('active');
            } else {
                circle.classList.remove('active');
            }
        });
    }

    function autoSlide() {
        activeIndex = (activeIndex + 1) % circles.length;
        updateSlider();
    }

    // Change slide every 3 seconds
    setInterval(autoSlide, 3000);
</script>

<?php include('layouts/footer.php') ?>