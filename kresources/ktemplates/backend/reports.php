
<h1 class="page-header">
   Reports

</h1>

<h3 class="bg-success"><?php display_message(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Product Id</th>
           <th>Order Id</th>
           <th>Price</th>
           <th>Product title</th>
           <th>Product quantity</th>
      </tr>
    </thead>
    <tbody>

      
  <?php
  // Example implementation of get_reports function
  function get_reports() {
      // Replace this with actual logic to fetch and display reports
      echo '<tr>
              <td>1</td>
              <td>101</td>
              <td>5001</td>
              <td>$25.00</td>
              <td>Sample Product</td>
              <td>2</td>
            </tr>';
  }
  get_reports();
  ?>


  </tbody>
</table>



