<!DOCTYPE html>
<html lang="en">
<title>PETS.CO - Search Catalogue</title>
<?php
  include "header.php";

  const CATEGORY_NAMES = ["Dog", "Food", "Accessory"];
  const SORT_NAMES = ["Price low to high", "Price high to low", "Rating high to low"];
?>

<div class="container" style="padding-top: 50px;">
  <!-- filter start -->
  <div class="selectable-card nav-wrapper">
    <form id="filter-form" action="search_catalogue.php" method="POST">
      <div class="row" style="margin: 0px;">
        <div class="col s6">
          <div class="col">
            <h6>Filter:</h6>
          </div>

          <div class="col">
            <ul id="filter_dropdown" class="dropdown-content">
              <li><a class="cyan-text" onclick="select_category(this)">Dog</a></li>
              <li><a class="cyan-text" onclick="select_category(this)">Food</a></li>
              <li><a class="cyan-text" onclick="select_category(this)">Accessory</a></li>
            </ul>
            <a class="btn dropdown-trigger cyan" data-target="filter_dropdown" style="margin-top: 5px;">
              <?php
                $category = -1;
                if (isset($_POST["category"])) $category = $_POST["category"];
                if ($category != -1)
                {
                  echo(CATEGORY_NAMES[$category]);
                } else echo("Select Category");
                echo("<input type='hidden' name='category' value=$category>");
              ?>
              <i class="material-icons right">arrow_drop_down</i>
            </a>
          </div>
        </div>

        <div class="col s6">
          <div class="col">
            <h6>Sort:</h6>
          </div>

          <div class="col">
            <ul id="sort_dropdown" class="dropdown-content">
              <li><a onclick="select_sort(this)">Price low to high</a></li>
              <li><a onclick="select_sort(this)">Price high to low</a></li>
              <li><a onclick="select_sort(this)">Rating high to low</a></li>
            </ul>
            <a class="btn dropdown-trigger" data-target="sort_dropdown" style="margin-top: 5px;">
              <?php
                $sort = -1;
                if (isset($_POST["sort"])) $sort = $_POST["sort"];
                if ($sort != -1)
                {
                  echo(SORT_NAMES[$sort]);
                } else echo("Select Sort Type");
                echo("<input type='hidden' name='sort' value=$sort>");
              ?>
              <i class="material-icons right">arrow_drop_down</i>
            </a>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- filter end -->

  <!-- item list start -->
  <div style="margin-top: 40px;">
    <div class="row center">
      <div class="col s3">
        <div href="#" class="selectable-card">
          <p>Just a simple paragraph.</p>
        </div>
      </div>
      <div class="col s3">
        <div href="#" class="selectable-card">
          <p>Just a simple paragraph.</p>
        </div>
      </div>
      <div class="col s3">
        <div href="#" class="selectable-card">
          <p>Just a simple paragraph.</p>
        </div>
      </div>
      <div class="col s3">
        <div href="#" class="selectable-card">
          <p>Just a simple paragraph.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- item list end -->
</div>

<script>
  // dropdown
  var form, category, sort;

  var categoryMap = {
    "Dog": 0,
    "Food": 1,
    "Accessory": 2
  };

  var sortMap = {
    "Price low to high": 0,
    "Price high to low": 1,
    "Rating high to low": 2
  };

  $('.dropdown-trigger').dropdown();
  $(document).ready(() =>
  {
    form = document.getElementById("filter-form");
    category = document.getElementsByName("category")[0];
    sort = document.getElementsByName("sort")[0];
  });

  function select_category(selectedItem)
  {
    var categoryId = categoryMap[selectedItem.textContent];
    category.value = categoryId;
    form.submit();
  }

  function select_sort(sortItem)
  {
    var sortId = sortMap[sortItem.textContent];
    sort.value = sortId;
    form.submit();
  }
</script>

<?php include "footer.php"; ?>
</html>