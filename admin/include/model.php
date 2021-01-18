
<?php if ($_SESSION['login_status1'] == 0): ?> 
<?php echo '<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="memberModalLabel">SYSTEM IS DEACTIVATED CONTACT YOUR DEVELOPER</h4>
      </div>
      <div class="modal-body">
        <p>Criteria Based Online Grading System Site.<BR>
        For more information and inquiries about this system contact the developer via Email or Facebook.<BR> 
		<strong><a href="mailto:143clarkz@gmail.com">EMAIL ME!</a></strong> <BR>
		<strong><a href="https://facebook.com/143Clarkz">MY FACEBOOK!</a> </strong>
		</p>
		

        <p>Thankyou,<BR>
		Clarence Andaya
		</p>
      </div>
      <div class="modal-footer">
             </div>
    </div>
  </div>
</div>'; ?>
<?php endif; ?>
<?php if ($_SESSION['login_status2'] == 1): ?> 
<?php echo '<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="memberModalLabel">THIS IS A DEMO WEBSITE! </h4>
      </div>
      <div class="modal-body">
        <p>Criteria Based Online Grading System Demo Site.<BR>
        For more information and inquiries about this system contact the developer via Email or Facebook.<BR> 
		<strong><a href="mailto:143clarkz@gmail.com">EMAIL ME!</a></strong> <BR>
		<strong><a href="https://facebook.com/143Clarkz">MY FACEBOOK!</a> </strong>
		</p>
		

        <p>Thankyou,<BR>
		Clarence Andaya
		</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>'; ?>
<?php endif; ?>

 