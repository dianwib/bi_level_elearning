<?php
$notifs = M_Notification::where('usr_id', '=', $this->session->userdata('id'))->get();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Table Basic</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($notifs as $notif) : ?>
                            <tr>
                                <td><i class='bx bx-timer'></i><?php echo time_ago($notif->ntf_time->format('U'))?></td>
                                <td><strong><?= $notif->ntf_instructor ?></strong></td>
                                <td><?= $notif->ntf_message?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>