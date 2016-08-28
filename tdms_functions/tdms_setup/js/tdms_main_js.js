var e                   = e || window.event,
    sidebarToggle       = document.getElementById("tdms_panel_toggle"),
    sidebarContainer    = document.getElementById("tdms_panel_contain"),
    toggleSlider        = document.getElementById("toggle_button_slider"),
    initialClickY,
    initialSliderTopVal,
    windowHeightSave,
    startToggleTop;

function pauseEvent(e){
    
    if(e.stopPropagation) e.stopPropagation();
    if(e.preventDefault) e.preventDefault();
    e.cancelBubble=true;
    e.returnValue=false;
    return false;
    
}
    


function removeListeners()
{
    
    window.removeEventListener("mouseup", removeListeners);
    window.removeEventListener("mousemove", dragSlider);
    window.removeEventListener("mouseup", removeListeners);
    
}

function responsivePosToggleButton()
{
    
    var calcRelPos;
    
    windowHeightSave = window.innerHeight;

    startToggleTop = parseInt(getComputedStyle(sidebarToggle).top) || 0;
    
    if(windowHeightSave == 0 || startToggleTop == 0)
    {
        
        calcRelPos = 0;
        
    }
    else
    {
        
        var calcPercentTop = startToggleTop / windowHeightSave;
        
        calcRelPos = calcPercentTop * windowHeightSave;
        
        
    }
    
    sidebarToggle.style.top = calcRelPos + "px";
    
}

function dragSlider(e)
{

    
    function calcTogglePosVal(e)
    {
        
        var clickRelToButton =  initialClickY - initialSliderTopVal,
            newPos;
        
        if((0 <= e.clientY - clickRelToButton) && ((e.clientY - clickRelToButton) < (window.innerHeight - sidebarToggle.offsetHeight)))
        {
            
            newPos = e.clientY - clickRelToButton
            
        }
        else
        {
            
            if((e.clientY - clickRelToButton) >= (window.innerHeight - sidebarToggle.offsetHeight))
            {
                
                newPos = window.innerHeight - sidebarToggle.offsetHeight;
                
            }
            else
            {
                
                newPos = 0;
                
            }
            
        }
        
        
        return newPos;
    }
        
    
    sidebarToggle.style.top = calcTogglePosVal(e) + "px";
    
}

function toggleSidebar()
{
    
    if(sidebarContainer.classList.contains('toggled'))
    {
        
        sidebarContainer.classList.remove('toggled');
        
    }
    else
    {
        
        sidebarContainer.classList.add('toggled');
        
    }
    
}

function toggleSidebarSetCond(e)
{
    pauseEvent(e);
    initialClickY = e.clientY;
    initialSliderTopVal = sidebarToggle.offsetTop;
    window.addEventListener("mouseup", removeListeners);
    
    if(e.target == toggleSlider)
    {
        
        window.addEventListener("mousemove", dragSlider);
        
    }
    else
    {
        
        toggleSidebar();
        
    }
    
}

sidebarToggle.addEventListener("mousedown", toggleSidebarSetCond);
window.addEventListener("resize", responsivePosToggleButton);