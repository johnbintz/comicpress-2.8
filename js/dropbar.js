
	var DropBarMover = new Object();
	DropBarMover.isMouseOver = false;
	DropBarMover.isFocus = false;
	DropBarMover.timerID = null;
	DropBarMover.DropBarInstance = null;
	
	DropBarMover.mouseOver = function (e)
	{
		this.isMouseOver = true;
		this.adjustDropBar();
	}
	DropBarMover.mouseOut = function (e)
	{
		this.isMouseOver = false;
		this.adjustDropBar();
}
	DropBarMover.focus = function (e)
	{
		this.isFocus = true;
		this.adjustDropBar();
}
	DropBarMover.blur = function (e)
	{
		this.isFocus = false;
		this.adjustDropBar();
}
	DropBarMover.adjustDropBar = function()
	{
		if ( this.timerID == null )
		{
			if ( !this.DropBarInstance )
				this.DropBarInstance = document.getElementById('DropBar');
			this.timerID = window.setInterval(function(){
				var Location = DropBarMover.DropBarInstance.style.top;
			
				Location = parseInt(Location.substr(0,Location.length-2));
				
				if ( DropBarMover.isMouseOver || DropBarMover.isFocus )
				{
					if ( Location < 0 )
					{	
						Location+=5;
						DropBarMover.DropBarInstance.style.top = Location + 'px';
					}
					else
					{
						window.clearInterval(DropBarMover.timerID);
						DropBarMover.timerID = null;
					}
				}
				else
				{
					if ( Location > -100 )
					{	
						Location-=5;
						DropBarMover.DropBarInstance.style.top = Location + 'px';
					}
					else
					{
						window.clearInterval(DropBarMover.timerID);
						DropBarMover.timerID = null;
					}
				}
				
			}, 20);
		}
	}
