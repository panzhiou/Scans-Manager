        </div>
        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text"><?=$this->lang->line('disclaimer'); ?></h5>
                <p class="grey-text text-lighten-4"><?=$this->lang->line('disclaimer_text'); ?></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!"><?=$this->lang->line('title_news'); ?></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!"><?=$this->lang->line('projects'); ?></a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">RSS</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014-2016 <?php echo $this->lang->line('title_site'); ?>
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="<?=base_url("assets/materialize/js/materialize.min.js"); ?>"></script>
    <script src="<?=base_url("assets/js/custom.js"); ?>"></script>
    <?php if($tipo=='reader_index') { ?>
    <script src="<?=base_url("assets/js/reader.js"); ?>"></script>
    <script src="<?=base_url("assets/js/jquery.hotkeys.js"); ?>"></script>
    <?php } ?>
    <?php if($tipo=='list') { ?>
    <script src="<?=base_url("assets/js/jquery.qtip.min.js"); ?>"></script>
    <script type="text/javascript">
      jQuery(document).ready(function() {
        jQuery('a[class^=id]').each(function(){
          var classe = jQuery(this).attr('class');
          var arrClasse = classe.split('_');
          var id = arrClasse[1];

          jQuery('.id_'+id).qtip({
            content: $('#block_tooltip_'+id),
            style: { classes: 'qtip-tipsy' },
            position: {
              target: 'mouse', // Track the mouse as the positioning target
              adjust: { x: 15, y: 15 } // Offset it slightly from under the mouse
            }
          });
        });
      });
    </script>
    <?php } ?>

</body>
</html>