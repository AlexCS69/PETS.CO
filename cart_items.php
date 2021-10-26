<?php
  /** @var Order $cart */
  $cartItems = $cart->GetOrderItems();
  $cartItemCount = count($cartItems);

  /**
   * @param string $itemName
   * @param int $categoryIdx
   * @param string $dateAdded
  */
  function GenerateItem($itemName, $categoryIdx, $dateAdded)
  {
    $iconName = Item::CATEGORY_ICON[$categoryIdx];
    $categoryName = Item::CATEGORY[$categoryIdx];
    return "
    <li>
      <div class='collapsible-header cyan white'><i class='material-icons'>$iconName</i>$itemName</div>
      <div class='collapsible-body row white' style='margin: 0px;'>
        <span class='col s6'>Date Added: $dateAdded</span>
        <span class='col s6'>Category: $categoryName</span>
      </div>
    </li>
    ";
  }
?>

<div class="row">
  <div class="col s8">
    <ul class="collapsible popout" id="cart">
      <li>
        <div class="collapsible-header cyan white"><i class="material-icons">pets</i>First</div>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Pet</span>
        </div>
      </li>
      <li>
        <div class="collapsible-header white"><i class="material-icons">toys</i>Second</div>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Accessory</span>
        </div>
      </li>
      <li>
        <div class="collapsible-header white"><i class="material-icons">restaurant</i>Third</div>
        <div class="collapsible-body row white" style="margin: 0px;">
          <span class="col s6">Date Added: </span>
          <span class="col s6">Category: Food</span>
        </div>
      </li>
    </ul>
  </div>

  <div class="col s4">
    <div class="card brown darken-3">
      <div class="card-content white-text">
        <span class="card-title" style="font-weight: bold;">Cart Details</span>
        <p>Total Items: </p>
        <p>Delivery Charges: </p>
        <p>Sum Total: </p>
      </div>
      <div class="card-action">
        <a href="#">Empty Cart</a>
      </div>
    </div>
  </div>
</div>