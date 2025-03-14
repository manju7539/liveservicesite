<!DOCTYPE html>
<html lang="en">

<head>

    <!-- FAVICONS ICON -->

</head>
<style>
.empty-state__message {
    color: #38a169;
    font-size: 1.5rem;
    font-weight: 500;
    margin-top: 0.85rem;
}

.empty-state {
    width: 750px;
    margin: 40px auto;
    background: #ffffff;
    box-shadow: 1px 2px 10px #e1e3ec;
    border-radius: 4px;
}

.outer-box a,
.outer-box a:hover,
.outer-box a:focus,
.outer-box a:active {
    text-decoration: none;
    outline: none;
}

.outer-box a,
.outer-box a:active,
.outer-box a:focus {
    text-align: center;
    color: #fb9f44;
    font-size: inherit;
    transition-timing-function: ease-in-out;
    -ms-transition-timing-function: ease-in-out;
    -moz-transition-timing-function: ease-in-out;
    -webkit-transition-timing-function: ease-in-out;
    -o-transition-timing-function: ease-in-out;
    transition-duration: .2s;
    -ms-transition-duration: .2s;
    -moz-transition-duration: .2s;
    -webkit-transition-duration: .2s;
    -o-transition-duration: .2s;
}

.outer-box ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.outer-box img {
    max-width: 100%;
    height: auto;
}

/*--blog----*/

.outer-box .sec-title {
    position: relative;
    margin-bottom: 70px;
}

.sec-title .title {
    position: relative;
    display: block;
    font-size: 16px;
    line-height: 1em;
    color: #ff8a01;
    font-weight: 500;
    background: rgb(247, 0, 104);
    background: -moz-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
    background: -webkit-linear-gradient(to left, rgba(247, 0, 104, 1) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
    background: linear-gradient(to left, rgba(247, 0, 104) 0%, rgba(68, 16, 102, 1) 25%, rgba(247, 0, 104, 1) 75%, rgba(68, 16, 102, 1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F70068', endColorstr='#441066', GradientType=1);
    color: transparent;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-transform: uppercase;
    letter-spacing: 5px;
    margin-bottom: 15px;
}

.sec-title h2 {
    position: relative;
    display: inline-block;
    font-size: 48px;
    line-height: 1.2em;
    color: #1e1f36;
    font-weight: 700;
}

.sec-title .text {
    position: relative;
    font-size: 16px;
    line-height: 28px;
    color: #888888;
    margin-top: 30px;
}

.sec-title.light h2,
.sec-title.light .title {
    color: #ffffff;
    -webkit-text-fill-color: inherit;
}

/* .pricing-section {
    position: relative;
    padding: 100px 0 80px;
    overflow: hidden;
} */

/* .pricing-section .outer-box {
    max-width: 1100px;
    margin: 0 auto;
} */


/* .pricing-section .row {
    margin: 0 -30px;
} */

.pricing-block {
    position: relative;
    padding: 0 6px;
    margin-bottom: 40px;
}

.pricing-block .inner-box {
    position: relative;
    background-color: #ffffff;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    padding: 0 0 30px;
    /* max-width: 370px;
    width: 258px; */
    margin: 0 auto;
    border-bottom: 20px solid #132239;
}

.pricing-block .icon-box {
    position: relative;
    padding: 50px 30px 0;
    background-color: #355980;
    text-align: center;
    width: 100%;
}

.pricing-block .icon-box:before {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 75px;
    width: 100%;
    border-radius: 50% 50% 0 0;
    background-color: #ffffff;
    content: "";
}


.pricing-block .icon-box .icon-outer {
    position: relative;
    height: 150px;
    width: 150px;
    background-color: #ffffff;
    border-radius: 50%;
    margin: 0 auto;
    padding: 10px;
}

.pricing-block .icon-box i {
    position: relative;
    display: block;
    height: 130px;
    width: 130px;
    line-height: 120px;
    border: 5px solid #40cbb4;
    border-radius: 50%;
    font-size: 50px;
    color: #40cbb4;
    -webkit-transition: all 600ms ease;
    -ms-transition: all 600ms ease;
    -o-transition: all 600ms ease;
    -moz-transition: all 600ms ease;
    transition: all 600ms ease;
}

.pricing-block .icon-box h4 {
    position: relative;
    display: block;
    height: 130px;
    width: 130px;
    line-height: 120px;
    border: 5px solid #48e4ff;
    border-radius: 50%;
    font-size: 24px;
    color: #132239;
    -webkit-transition: all 600ms ease;
    -ms-transition: all 600ms ease;
    -o-transition: all 600ms ease;
    -moz-transition: all 600ms ease;
    transition: all 600ms ease;
}

.pricing-block .inner-box:hover .icon-box i {
    transform: rotate(360deg);
}

.pricing-block .price-box {
    position: relative;
    text-align: center;
    padding: 10px 20px;
}

.pricing-block .title {
    margin-top: -32px;
    position: relative;
    display: block;
    font-size: 24px;
    line-height: 1.2em;
    color: white;
    font-weight: 600;
}

.pricing-block .price {
    display: block;
    font-size: 30px;
    color: #222222;
    font-weight: 700;
    color: #40cbb4;
}


.pricing-block .features {
    position: relative;
    /* max-width: 251px; */
    /*margin: -11px 18px 13px;*/
    margin: 20px;

}

.pricing-block .features li {
    position: relative;
    display: block;
    font-size: 14px;
    line-height: 30px;
    color: #848484;
    font-weight: 500;
    padding: 5px 0;
    padding-left: 30px;
    border-bottom: 1px dashed #dddddd;
}

.pricing-block .features li:before {
    position: absolute;
    left: 0;
    top: 50%;
    font-size: 16px;
    color: #2bd40f;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f058";
    font-family: "Font Awesome 5 Free";
    margin-top: -8px;
}

.pricing-block .features li.false:before {
    color: #e1137b;
    content: "\f057";
}

.pricing-block .features li a {
    color: #848484;
}

.pricing-block .features li:last-child {
    border-bottom: 0;
}

.pricing-block .btn-box {
    position: relative;
    text-align: center;
}

.pricing-block .btn-box a {
    position: relative;
    display: inline-block;
    font-size: 14px;
    line-height: 25px;
    color: #ffffff;
    font-weight: 500;
    padding: 8px 30px;
    background-color: #132239;
    border-radius: 10px;
    border-top: 2px solid transparent;
    border-bottom: 2px solid transparent;
    -webkit-transition: all 400ms ease;
    -moz-transition: all 400ms ease;
    -ms-transition: all 400ms ease;
    -o-transition: all 400ms ease;
    transition: all 300ms ease;
}


.pricing-block .btn-box a:hover {
    color: #ffffff;
}

.btn-box a:hover {
    /* color: #48e4ff;
    background: none;*/
    border-radius: 10px;
    /*border-color: #48e4ff;*/
    border: 4px solid #48e4ff;
}


/* .pricing-block .inner-box:hover .icon-box h4 {
    transform: rotate(360deg);
} */
</style>

<body>
    <!--*******************
         Preloader start
         ********************-->
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Buy Plan</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                href="<?php echo base_url('Dashboard')?>">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="">Manage Menus</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Buy Plan</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-topline-aqua">
                        <div class="card-head">
                            <header><span class="page_header_title11">Buy Plan</span></header>

                        </div>

                        <?php
                    if($this->session->flashdata('msg'))
                    {
                ?>
                        <div class="alert alert-primary" role="alert">
                            <strong style="color:black"><?php echo $this->session->flashdata('msg') ?></strong>
                        </div>
                        <?php
                    }
                ?>

                        <div class="text-center ">
                            <button type="submit" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter" style="margin-bottom:10px;margin-top:10px;"> Add
                                Wallet Amount</button>
                        </div>

                        <section class="pricing-section">
                            <div class="container">
                                <div class="outer-box">
                                    <div class="row">
                                        <!-- Pricing Block -->
                                        <?php

                                    $admin_id = $this->session->userdata('u_id');

                                    if($list)
                                    {
                                        foreach($list as $l_p)
                                        {
                                ?>

                                        <div class="pricing-block col-lg-3 col-md-4 wow fadeInUp">
                                            <div class="inner-box">
                                                <div class="icon-box">
                                                    <div class="title"> <?php echo $l_p['ledas_name']?></div>

                                                    <div class="icon-outer">
                                                        <h4 class="price">₹<?php echo $l_p['amount']?></h4>
                                                    </div>
                                                </div>
                                                <!-- <div class="price-box">
                                                    </div>-->
                                                <ul class="features">
                                                    <div class="article">
                                                        <p><?php echo $l_p['description']?></p>
                                                    </div>
                                                </ul>
                                                <div class="btn-box">
                                                    <a href="<?php echo base_url('HoteladminController/purchase_leads/'.$admin_id.'/'.$l_p['leads_plan_id'].'/'.$l_p['amount'])?>"
                                                        class="theme-btn">Buy plan</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                        <div class="text-center">
                                            <div class="empty-state__message">No Leads has been added yet.</div>
                                        </div>
                                        <?php
                                    }
                                ?>



                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- </div> -->


                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Amount</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <form action="<?php echo base_url('HoteladminController/add_wallet_points')?>" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label">Enter Amount</label>
                                        <!-- <input type="number" id="amount" min="1" onkeyup="check_amount()" name="amount" class="form-control" placeholder="Enter amount"> -->
                                        <input type="number" id="amount" min="1" name="amount" class="form-control"
                                            placeholder="Enter amount" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->


    <!-- automatic hide session data -->
    <script>
    $(document).ready(function() {
        $('.alert').delay(4000).fadeOut();
    });
    </script>
    <!-- automatic hide session data -->

    <!-- check amount -->
    <script>
    function check_amount() {
        var base_url = '<?php echo base_url()?>';
        var amount = $('#amount').val();
        // alert(amount);

        $.ajax({
            url: base_url + 'AdminController/check_amount',
            method: "post",
            data: {
                amount: amount
            },
            success: function(data) {
                // alert(data);
                if (data == 1) {
                    alert('Enter valid amount');
                    document.getElementById('amount').value = '';
                }
            }
        });
    }
    </script>

    <script>
    $readMoreJS.init({
        target: '.article p',
        numOfWords: 10,
        toggle: true,
        moreLink: 'read more ...',
        lessLink: 'read less'
    });
    </script>


</body>

</html>