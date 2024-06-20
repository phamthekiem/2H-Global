<?php
get_header();

// defined
$banner1 = "https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/a0165ece-download-44.png";
$banner2 = "https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/57256114-j000287-s1-002-0605-alt2-64cbd78.png";
$banner3 = "https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/04988b11-j000287-s1-002-0704-ext-alt-ext.png";
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Polo4man</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   </head>
   <body>
      <section>
         <div class="container">
            <div class="row">
               <div class="col-12 p-0 rounded-4 overflow-hidden">
                  <img class="w-100" src="<?= $banner1 ?>" alt="banner">
               </div>
            </div>
         </div>
      </section>
      <div class="my-5"></div>
      <section>
         <div class="container">
            <div class="row">
               <div class="col-12">
                <p class="text-center color-primary title">Trending Now</p>
               </div>
            </div>
            <div class="my-4"></div>

            <?php include get_template_directory() . '/template-parts/product/index.php'; ?>
         </div>
      </section>
      <div class="my-5"></div>
      
      <section>
         <div class="container">
            <div class="row overflow-hidden rounded-4">
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner2 ?>" alt="banner">
               </div>
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner3 ?>" alt="banner">
               </div>
            </div>

            <div class="my-5"></div>

            <?php include get_template_directory() . '/template-parts/tabs/index.php'; ?>
         </div>
      </section>

      <div class="my-5"></div>
      <section>
         <div class="container">
            <div class="row overflow-hidden rounded-4">
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner2 ?>" alt="banner">
               </div>
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner3 ?>" alt="banner">
               </div>
            </div>

            <div class="my-5"></div>

            <?php include get_template_directory() . '/template-parts/tabs/index.php'; ?>
         </div>
      </section>

      <div class="my-5"></div>
      <section>
         <div class="container">
            <div class="row overflow-hidden rounded-4">
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner2 ?>" alt="banner">
               </div>
               <div class="col-6 p-0">
                  <img class="w-100 h-100" src="<?= $banner3 ?>" alt="banner">
               </div>
            </div>

            <div class="my-5"></div>

            <?php include get_template_directory() . '/template-parts/tabs/index.php'; ?>
         </div>
      </section>

      <div class="py-5"></div>

      <section>
        <div class="container">
          <div class="row border-top-dashed py-3">
            <div class="col-12">
              <p class="text-center color-primary title">Shop By Recipient</p>
            </div>
          </div>

          <div class="row">
            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Bestie</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Lover</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Sibling</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Pet Lover</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Family</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Mom</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Dad</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-pill" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">For Kid</p>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </section>

      <section>
        <div class="container">
          <div class="row border-top-dashed py-3">
            <div class="col-12">
              <p class="text-center color-primary title">Shop By Product</p>
            </div>
          </div>

          <div class="row">
            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Burberry</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Dolce & Gabbana</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Gucci</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Hermes</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Louis Vuitton</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Ralph Lauren</p>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-3 p-3">
              <a href="#">
                <div class="box-image">
                  <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
                </div>
                <div class="box-text">
                  <div class="title-wrapper mt-3">
                    <p class="text-center fs-1 text-black">Versace</p>
                  </div>
                </div>
              </a>
            </div>

          </div>
        </div>
      </section>

      <section>
        <div class="container">
          <div class="row border-top-dashed py-3">
            <div class="col-12">
              <p class="text-center color-primary title">Happy Customer</p>
            </div>
          </div>

          <div class="row">
            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>

            <div class="col-3 p-3">
              <div class="box-image">
                <img class="w-100 rounded-5" src="https://storage.googleapis.com/cdn.2hglobalgate.com/polo4man.com/2024/05/5a7f0ebd-1-3-scaled-1.jpg" alt="product image">
              </div>
            </div>
          </div>
        </div>
      </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   </body>
</html>

<?php
get_footer();