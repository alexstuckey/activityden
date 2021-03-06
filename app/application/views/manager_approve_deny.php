<!-- Manager can Approve/Deny Shifts Div -->
<div id="managerShiftResponse">
    <h1>Respond to Applications</h1>

    <?php if (isset($message)) {
        echo '<p class="alert alert-success">'.$message.'</p><br>';
    } elseif (isset($error)) {
        echo '<p class="alert alert-danger">'.$error.'</p><br>';
    }?>

    <div class="card">
        <div class="card-header">
            <h4>My managees</h4>
        </div>
        <div class="card-block">
            <ul>
            <?php if (count($managees) == 0): ?>
                <li><i>You have not confirmed any users as managees.</i></li>
            <?php endif;
                  foreach ($managees as $managee): ?>
                <li><?php echo $managee['firstName'] . ' ' . $managee['secondName']; ?></li>
            <?php endforeach; ?>
            </ul>

            <?php if (count($manageesNominated) > 0): ?>
                <h5>Nominated (waiting for your approval)</h5>
                <ul>
                <?php foreach ($manageesNominated as $managee): ?>
                    <li><?php echo $managee['firstName'] . ' ' . $managee['secondName']; ?></li>
                <?php endforeach; ?>
                </ul>
                <a class="btn btn-primary" href="<?php echo site_url('/respond/nomination'); ?>">Go to approvals</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Approve Volunteering Requests</h4>
        </div>
        <div class="card-block">
            <form method="POST" action="<?php echo site_url('/time/manager_response'); ?>" id="shiftResponseForm">
                <div class="form-group">
                    <label for="shiftResponseSelect">Select Shift</label>
                    <select class="form-control" id="shiftResponseSelect" name="shiftResponseSelect">
                        <?php foreach ($managees as $managee): ?>
                            <?php foreach ($managee['times'] as $entries): ?>
                                <option value="<?php echo $entries['timeID']; ?>">
                                    <?php echo $entries['cisID'] . ': ' . $entries['start'] . ' to ' . $entries['finish'] . ' at ';?>
                                    <?php foreach ($causes as $cause) {
                                        if ($cause['causeID'] == $entries['causeID']) echo $cause['organisation'] . '.';
                                    };?>
                                    <?php if ($entries['teamChallenge'] === '1'): ?>
                                        <?php echo 'TEAM CHALLENGE.'; ?>
                                    <?php endif ?>
                                    </option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="shiftResponseRadios" id="shiftResponseRadio1" value="confirmed">
                        Permit
                    </label>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="shiftResponseRadios" id="shiftResponseRadio2" value="denied">
                        Deny
                    </label>
                </div>

                <div class="form-group">
                    <label for="shiftResponseComment">Comment (Optional)</label>
                    <textarea class="form-control" id="shiftResponseComment" rows="3" name="shiftResponseComment"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary" id="shiftResponseButton">Submit</button>
            </form>
        </div>
    </div>

    <!-- View Upcoming Activities for managees-->
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Upcoming Managee Activities</h5>
            </div>
            <div class="activityTable">
                <div class="card-block">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">CIS ID</th>
                            <th scope="col">Cause</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- upcoming activities using if statement if start time is in future -->
                        <!-- replace cause id with organisation relating to that cause id -->
                        <?php foreach ($managees as $managee): ?>
                            <?php foreach ($managee['timesUpcoming'] as $entries): ?>
                                <tr>
                                    <th scope="row"><?php echo $entries['timeID']; ?></th>
                                    <td><?php echo $entries['cisID']; ?></td></td>
                                    <td><?php foreach ($causes as $cause) { if ($cause['causeID'] == $entries['causeID']) echo $cause['organisation']; };?></td>
                                    <td><?php echo $entries['start']; ?></td>
                                    <td><?php echo $entries['finish']; ?></td>
                                    <td><?php echo $entries['comment']; ?></td>
                                    <td><?php if ($entries['teamChallenge'] == '1') {echo 'Team';} else {echo 'Individual';}; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- End of Manager can Approve/Deny Shifts Div -->

