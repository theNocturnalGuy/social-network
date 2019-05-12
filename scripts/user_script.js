var cmnt_box=document.getElementsByClassName('user-comment');
var show_hide_CommentBox=(postnum) => {
	if(this.cmnt_box[postnum-1].style.display==='block')
		this.cmnt_box[postnum-1].style.display='none';
	else
		this.cmnt_box[postnum-1].style.display='block';
}
var addComment=(postid,postnum) => {
	var cmnt_form=this.cmnt_box[postnum-1];
	var comment=document.getElementsByName('cmnt-content')[postnum-1];
	if(comment.value==="")
		alert("Your comment is empty.");
	else
	{
		$.ajax({
			url: 'functions/user_comment.php',
			type: 'post',
			data: $(cmnt_form).serialize(),
			success:(response) => {
				cmnt_form.reset();
				loadMoreComments(postid,postnum,0);
			}
		});	
		show_hide_CommentBox(postnum);
	}
	return false;
}
var nCmnt=0;
var loadMoreComments=(postid,postnum,nCmntVal) => {
	nCmnt=nCmntVal;
	var comments=document.getElementsByClassName('comments')[postnum-1];
	$(comments).load('functions/user_load_comment.php',{
		nCmnt:nCmnt,
		postid:postid,
		postnum:postnum
	});
}
var hideCommentCount=(postnum) => {
	var commentCount=document.getElementsByClassName('icon-comment')[postnum-1];
	commentCount.innerHTML='';
}