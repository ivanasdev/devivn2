

<div class="card abs-center">
<form id="formAM">
				<input type="hidden" name="idSucursal" id="idSucursal" value="<?php echo $idSucursal; ?>" />
				<table id="tablaForm">
					<tr>
						<!-- <td>Seleccionar sucursal: </td> -->
						<!-- <td> -->
						<?= $checkBoxSucursalesInsumo ?>
						<!-- </td> -->
					</tr>

					<tr>
						<td colspan="2" align="center">
							<input type="submit" id="btnEnviar" name="submit" value="Enviar" class="botonAzul">
							<!--<input type='hidden' value='' id='insumos' name='insumos' />-->
						</td>
					</tr>

				</table>
			</form>
</div>