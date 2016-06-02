
<div  class="col-md-8 top-bufer bottom-buffer">
    <h2 >Menu </h2>
        <div  style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('menu/create'),'Crear', 'class="btn btn-primary"'); ?>
                <a class="btn btn-danger" href="<?php echo base_url()?>"> Regresar</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('menu/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('menu'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Buscar</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nombre</th>
		<th>Action</th>
            </tr><?php
            foreach ($menu_data as $menu)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $menu->nombre ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('menu/read/'.$menu->idmenu),'Read'); 
				echo ' | '; 
				echo anchor(site_url('menu/update/'.$menu->idmenu),'Update'); 
				echo ' | '; 
				echo anchor(site_url('menu/delete/'.$menu->idmenu),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total  : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('menu/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('menu/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    