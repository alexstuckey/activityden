<!-- Cause Div -->
<div id="volunteering">
    <h1>Cause</h1>

    <div class="card">
        <div class="card-header">
            <h4><?php echo $cause['organisation']; ?></h4>
        </div>
        <div class="card-block">
            <h5>Notes</h5>
            <div>
                <p><?php echo $cause['notes']; ?></p>
            </div>
            <h5>Contact</h5>
            <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title"><?php echo $cause['contactName']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $cause['contactEmail']; ?></h6>
                <p class="card-text"><?php echo $cause['contactPhone']; ?></p>
              </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Cause Div -->