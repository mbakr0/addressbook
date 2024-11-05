<?php include'core/init.php';?>
<?php 
    $db = new Database();
    $db->query("SELECT * FROM contacts");
    $contacts = $db->resultset();
?>
      <div class="grid-container">
        <div class="grid-y">
          <div class="cell large-12">
            <table class="unstriped">
              <thead>
                <tr>
                  <th width="200" class="text-center">Names</th>
                  <th width="130" class="text-center">Phone</th>
                  <th width="200" class="text-center">Email</th>
                  <th width="250" class="text-center">Address</th>
                  <th width="100" class="text-center">Group</th>
                  <th width="150" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($contacts as $contact):?>
                <tr>
                  <td class="text-center"><a href="contact.html"><?php echo $contact->first_name.' '.$contact->last_name;?></a></td>
                  <td class="text-center"><?php echo $contact->phone;?></td>
                  <td class="text-center"><?php echo $contact->email;?></td>
                  <td>
                    <ul>
                      <li class="text-center"><?php echo $contact->address1;?> <?php echo $contact->address2;?></li>
                      
                      <li class="text-center"><?php echo $contact->city;?><?php echo $contact->state;?><?php echo $contact->zipcode;?></li>
                    </ul>
                  </td>
                  <td class="text-center"><?php echo $contact->contact_group;?></td>
                  <td>
                    <ul class="button-group">
                      <li><a href="#" class="button tiny" data-open="myModel">Edit</a></li>
                      <li><a href="#" class="button tiny [secondary alert success]" >Delete</a></li>
                    </ul>
                  </td>
                </tr>
               <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>