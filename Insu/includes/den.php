<form id="FORMDEN" method="POST" action="doEditaInsumo.php">
				<input type="hidden" name="idSucursal" id="idSucursal" value="<?php echo $idSucursal; ?>" />
				<table id="tablaForm">
					<tr>

						<?= $checkBoxSucursalesInsumoDEN ?>

					</tr>

					<tr>
						<td colspan="2" align="center">
							<input type="submit" id="btnEnviar" name="submit" value="Enviar" class="botonAzul">

						</td>
					</tr>

				</table>
			</form>