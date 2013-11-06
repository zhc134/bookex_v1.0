        // placeholder 兼容 
        $(function(){ 
          if(!$.support.placeholder){ 
            $('input[placeholder],textarea[placeholder]').each(function(){ 
              var that = $(this), 
              text= that.attr('placeholder'); 
              if(that.val()===""){ 
                that.val(text).addClass('placeholder'); 
              } 
              that.focus(function(){ 
                if(that.val()===text){ 
                  that.val("").removeClass('placeholder'); 
                } 
              }) 
              .blur(function(){ 
                if(that.val()===""){ 
                  that.val(text).addClass('placeholder'); 
                } 
              }) 
              .closest('form').submit(function(){ 
                if(that.val() === text){ 
                  that.val(''); 
                } 
              }); 
            }); 
          } 
        }); 