

(function(){
	Comment=function(el){
		this.init(el);
	};
	
Comment.prototype={
		createElements:function(el){
			this.$item=$(el);
			this.$mark=this.$item.find('div.post div.mark');
			this.$manage=this.$item.find('div.post div.details span.manage');
			this.$replyBtn=this.$manage.find('span.reply');
			this.$editBtn=this.$manage.find('span.edit');
			
			var obj=this;
			this.req={
				del:{
					$btn:obj.$manage.find('span.delete'),
					path:function(){return '/ajax/im/delete/'+$form.$roomId.attr('value')+'/'+obj.$item.attr('id')},
					suCallback:function(msg){obj.resDel.call(obj,msg)}   
				},
				restore:{//������������ ��������� (�� ����������� ����)
					path:function(){return '/ajax/im/restore/'+$form.$roomId.attr('value')+'/'+obj.$item.attr('id')}              
				},
				abuse:{//������
					$btn:obj.$manage.find('span.complain'),
					path:function(){return '/ajax/im/abuse/'+$form.$roomId.attr('value')+'/'+obj.$item.attr('id')}, 
					suCallback:function(msg){obj.resAbuse.call(obj,msg)}   
				},
				voteUp:{
					$btn:obj.$mark.find('span.up'),
					path:function(){return '/ajax/im/vote/'+$form.$roomId.attr('value')+'/'+obj.$item.attr('id')+'/up'},
					suCallback:function(msg){obj.resVoteUp.call(obj,msg)}
				},
				voteDown:{
					$btn:obj.$mark.find('span.down'),
					path:function(){return '/ajax/im/vote/'+$form.$roomId.attr('value')+'/'+obj.$item.attr('id')+'/down'},
					suCallback:function(msg){obj.resVoteDown.call(obj,msg)}
				}
			}
		},
		init:function(el){
			this.createElements(el);
			this.addReply();
			this.addEdit();
			this.addReq();
		},
		resDel:function(msg){
			this.$manage.remove();
			this.$mark.remove();
			this.$item.find('div.post div.entry p').html('<span class="deleted">����������� ������</span>');
			$('div.irhComments span.counter').html( parseInt($('div.irhComments span.counter').html()) - 1 );
		},
		resAbuse:function(msg){
			this.addTooltip('�������, ������������� ������� �������� �� ���� �����������', this.req['abuse'].$btn);
		},
		resVoteDown:function(msg){
			this.req['voteDown'].$btn.html('<span>'+(-msg.rating[0])+'</span>');
		},
		resVoteUp:function(msg){
			this.req['voteUp'].$btn.html('<span>'+msg.rating[1]+'</span>');
		},
		addReq:function(){
			var obj=this;
			for(var key in this.req){
				if(!this.req[key].$btn || !this.req[key].$btn.length) continue;
				
				this.req[key].$btn.click((function(key){return function(){
				
					if(obj.req[key].isSendAjax) return false;
					obj.req[key].isSendAjax=true;
					
					var $btn=$(this);
					$.ajax({
						type: 'get',
						url:obj.req[key].path(),
						dataType:'json',
						success:function(msg){
							if(msg.status){
								if(obj.req[key].suCallback) obj.req[key].suCallback(msg);
							}
							else obj.addTooltip.call(obj, ajaxErrors[msg.detail], $btn);
							obj.req[key].isSendAjax=false;
						} 
					});			
				}})(key));
			}
		},
		addEdit:function(){
			if(!this.$editBtn.length) return false;
			var obj=this;
			this.$editBtn.click(function(event){
				event.stopPropagation();
				
				var newLeft=obj.$item.css('margin-left');
				var newTop=obj.$item.position().top-$form.startTop+obj.$item.height()+3; //��������� ������ ��� ��7
				
				var btn=this;
				$form.animate({left:newLeft, top:newTop}, {duration:500, complete:function(){
					$form.$parentId.attr('value', '');
					$form.$imAction.attr('value', 'edit');     
					$form.$messageId.attr('value', obj.$item.attr('id')); 
					$form.$textarea.attr('value', btn.getAttribute('data-raw'));       
					$form.$textarea.focus();
				}});
			});			
		},	
		addReply:function(){
			if(!this.$replyBtn.length) return false;
			var obj=this;
			this.$replyBtn.click(function(event){
				event.stopPropagation();
				
				var newLeft=obj.$item.css('margin-left');
				var newTop=obj.$item.position().top-$form.startTop+obj.$item.height()+3; //��������� ������ ��� ��7
				
				$form.animate({left:newLeft, top:newTop}, {duration:500, complete:function(){
					$form.$parentId.attr('value', obj.$item.attr('id'));
					$form.$imAction.attr('value', 'add');     
					$form.$messageId.attr('value', ''); 
					//$form.$textarea.attr('value', ''); 
					$form.$textarea.focus();
				}});
			});			
		},	
		addTooltip:function(txt, $btn){
			var pos=$btn.offset();
			var obj=this;
			if(!tooltip){
				tooltip=document.createElement('DIV');
				tooltip.className = 'tooltip';
				document.body.appendChild(tooltip);
			}
			
			try{clearTimeout(stopTooltip)} catch (e) {}
			
			tooltip.innerHTML=txt;
			tooltip.style.cssText='left:'+pos.left+'px; top:'+(pos.top-30)+'px;';
			
			stopTooltip=setTimeout(function(){
				tooltip.style.cssText='left:-9999px;top:-s9999px;';
				tooltip.innerHTML='';
			}, 2000);
		}
	}
	
	
	
	
	//
	var $form,$writeNewComment,tempContPost,$commentsTrack;
	var tooltip,stopTooltip;//���� � ����������, ���������
	
	
	var comments=[];
	var ajaxErrors={
		no_login : '�� �� ������������',
		banned : '�� ����� ���� ���� � ������ � ��� ��� ����������� ��������� �����������',
		room : '����������� ���� roomId',
		emply : '��������� �� ������ ���� ������',
		spam : '���� �������� ����� ������ �� ����!',
		voted_already: '�� ��� ����������',
		voted_own:'��� ��� �����������',
		abused_already: '�� ��� ���������� �� ���� �����������',
		abused_own: '��� ��� �����������',
        error: '����������� ������'
	}
	
	//
	$(window).load(function(){

		//�������� �� ������� � ������ ��������
		$writeNewComment=$('#write_new_comment');
		if($writeNewComment.length){
			$writeNewComment.click(function(event){		
				event.preventDefault();	
				$('html, body').animate({scrollTop:$('#write_comment').offset().top},{duration:500, complete:function(){
					try{
						$form.$textarea.attr('value', '');
						$form.$textarea.focus();
					}catch(e){}
				}});   	
			});
		}
		
		//���� ��� ����� - ���������� ������ �������
		$form=$('#comments_form');
		if(!$form.length) return false;
		
		function getLevel($el){//�������� ������� �����������
			if($el[0].className.indexOf('level')!=-1) return parseInt($el[0].className.match(/\.*level-(\d+)/)[1]);
			else return 1;
		}		
		
		//�������� � ������
		$form.startTop=$form.position().top;
		$form.$parentId=$form.find('input[name=parentId]');
		$form.$roomId=$form.find('input[name=roomId]');
		$form.$imAction=$form.find('input[name=imAction]');
		$form.$messageId=$form.find('input[name=messageId]');
		$form.$textarea=$form.find('textarea'); 
		
		$form.click(function(event){
			event=event||window.event;
			event.stopPropagation ? event.stopPropagation() : (event.cancelBubble=true)
		});
		
		
		
		
		$form.submit(function(event){
			event.preventDefault();
			if(this.content.value==''){
				alert('����������� �� ����� ���� ����!'); 
				return false;
			}
			if(this.method!='post'){
				alert('������ �� �������� ��� �������� ����� ������� GET. ����������');
				return false;
			}
			
			//�������� ��� ������ � �����
			var postData='';
			for(var i=0,j=this.elements.length;i<j;i++){
				postData+=this.elements[i].name+'='+this.elements[i].value+'&';
			}
			postData=postData.replace(/&$/, '');
			$.ajax({
				type: "post",
				url: $form.attr('action'),
				data: postData,	
				dataType:'json',
				success:function(msg){
					if(!msg.status){
						alert(ajaxErrors[msg.detail]);
						return false;
					}
					
					//����� �������������, �������� ��� �������� - ������ ������, ����� ����-�� ��� ��������������
					
					//���� ��������� ��������� ��� �������� ��������� ��� �� ������ ��� �� ������ - ������� ���
					if(!tempContPost){
						tempContPost=document.createElement('DIV');
						tempContPost.className='trackContainer commentsTrack';
						tempContPost.style.cssText='position:absolute;left:-9999px;top:-9999px;width:1px;height:1px;overflow:hidden;';
						document.body.appendChild(tempContPost);
						
						$commentsTrack=$('div.commentsTrack');						
					}
					tempContPost.innerHTML=msg.message
					var item=tempContPost.childNodes[0];
					
					//���� �������������
					if($form.$imAction.attr('value')=='edit'){
						for(var i=0,j=comments.length;i<j;i++){
							if(comments[i].$item.attr('id')==$form.$messageId.attr('value')){
								$commentsTrack[0].insertBefore(item, comments[i].$item[0]);
								$commentsTrack[0].removeChild(comments[i].$item[0]);
								comments.splice(i, 1, new Comment(item));
								break;
							}
						}
					}
					
					//���� �������� ����-��
					else if($form.$parentId.attr('value')){
						for(var i=0,j=comments.length;i<j;i++){
							if(comments[i].$item.attr('id')==$form.$parentId.attr('value')){
								//���� �� ��������� ������� ������� ���� ���������, ����� ��������� � �����
								if(i!=j-1){
									//����� �������� � ����� �������
									var answerLevel=getLevel(comments[i].$item)+1;
									for(var m=i+1;m<j;m++){
										if(getLevel(comments[m].$item)<answerLevel){
											$commentsTrack[0].insertBefore(item, comments[m].$item[0]);
											comments.splice(m, 0, new Comment(item));
											break;
										}
										else if(m==j-1){//���� ����� ������� � ����� �������� ���������
											$commentsTrack[0].appendChild(item);
											comments.push(new Comment(item));
										}
									}
								}
								else {
									$commentsTrack[0].appendChild(item);
									comments.push(new Comment(item));
								}
								break;
							}
						}
					}
					//������ ������
					else{
						$commentsTrack[0].appendChild(item);
						comments.push(new Comment(item));
					}
					
					//���������� �������� �����
					$form.$parentId.attr('value', '');			
					$form.$imAction.attr('value', 'add');     
					$form.$messageId.attr('value', ''); 
					$form.$textarea.attr('value', '');
					$form.css({left:0,top:0});
					$form.startTop=$form.position().top;		
					
					$('div.irhComments span.counter').html( parseInt($('div.irhComments span.counter').html())+1 );
				} 
			});			
		});
		
		//��� ����� �� ���� - ���������� ����� � �������� ���������
		$(document).click(function(){
			$form.$parentId.attr('value', '');			
			$form.$imAction.attr('value', 'add');     
			$form.$messageId.attr('value', ''); 
			
			$form.animate({left:0, top:0}, {duration:500, complete:function(){
				$form.startTop=$form.position().top; //������� �� �����, (����� ����� �������� ������) 
			}});		
		});
		
		// comments
		$('div.commentsTrack div.trackItem').each(function() {
			comments.push(new Comment(this));
		});	
	});
})();










