<div class="row">
    <div class="col-12 p-0">
        <ul class="nav nav-pills mb-3 w-100 d-block" id="pills-tab" role="tablist">
            <div class="row w-100">
                <div class="col-3 p-0">
                    <li class="nav-item" role="presentation">
                        <button class="btn text-white background-primary rounded-5 w-100 py-3 btn-active" id="tab-1" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pill-1" aria-selected="true">POLO RALPH LAUREN</button>
                    </li>
                </div>
                <div class="col-3 p-0">
                    <li class="nav-item" role="presentation">
                        <button class="btn text-white background-primary rounded-5 w-100 py-3" id="tab-2" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">POLO LOUIS VUIITON</button>
                    </li>
                </div>
                <div class="col-3 p-0">
                    <li class="nav-item" role="presentation">
                        <button class="btn text-white background-primary rounded-5 w-100 py-3" id="tab-3" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">POLO VERSACE</button>
                    </li>
                </div>
                <div class="col-3 p-0">
                    <li class="nav-item" role="presentation">
                        <button class="btn text-white background-primary rounded-5 w-100 py-3" id="tab-4" data-bs-toggle="pill" data-bs-target="#pills-4 type="button" role="tab" aria-controls="pills-4" aria-selected="false">POLO GUCCI</button>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1">
            <?php include get_template_directory() . '/template-parts/product/index.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2">
            <?php include get_template_directory() . '/template-parts/product/index.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3">
            <?php include get_template_directory() . '/template-parts/product/index.php'; ?>
            </div>
            <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4">
            <?php include get_template_directory() . '/template-parts/product/index.php'; ?>
            </div>
        </div>
    </div>
</div>