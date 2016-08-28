var formFieldNodes = document.querySelectorAll("form span input[type='text']"),
    e = e || window.event,
    tooltipContainer = document.getElementById('setupInformation');
    defaultTooltip = tooltipContainer ? document.getElementById('setupInformation').innerHTML : "";



function modifyTextFieldLabel(e)
{
    
    var textFieldLabel = e.target.previousElementSibling.tagName === "LABEL" ? e.target.previousElementSibling : "";
    
    if(textFieldLabel)
    {
        
        if(e.target === document.activeElement)
        {
            
            textFieldLabel.className = "label-field-focus";
            
        } else {
            
            if(!e.target.value)
            {
                
                textFieldLabel.className = "label-field-empty";
                
            } else {
                
                textFieldLabel.className = "label-field-filled-nofocus";
                
            }
            
        }
            

    } else {
        
        return;
        
    }
    
}

function modifyTooltip(e)
{
    
    var toolTip = e.target.getAttribute('data-tooltip'),
        tipTitle = e.target.previousElementSibling.tagName === "LABEL" ? e.target.previousElementSibling.innerHTML : false;
    
    if(toolTip && e.target === document.activeElement)
    {
        toolTip = tipTitle ? "<span class='tooltip-title'>" + tipTitle + "</span></br>" + toolTip : toolTip;
        tooltipContainer.innerHTML = toolTip;
            

    } else {
        
        tooltipContainer.innerHTML = defaultTooltip;
    }
    
}

function changeSubmitState()
{
    
    var invalidInputs = document.querySelectorAll("[data-cannot-send='true']"),
        emptyInputs = document.querySelectorAll(".label-field-empty [data-required='true']"),
        submitButton = document.querySelectorAll("form input[type='submit']");
    
    if(invalidInputs.length > 0 || emptyInputs.length > 0)
    {
        
        submitButton[0].disabled = true;
        
    } else {
        
        submitButton[0].disabled = false;
        
    }
    
}

function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}

function showErrorMessages(elem)
{
    
    var patternExpl = elem.getAttribute('data-pattern-expl') ? elem.getAttribute('data-pattern-expl') : "",
        isRequired = elem.getAttribute('data-required') ? elem.getAttribute('data-required') : 'false';
    
    if(hasClass(elem, "invalid"))
    {
        
        if(!elem.parentElement.querySelectorAll(".error-info")[0])
        {
            var errorInfo = document.createElement("span");

            if(isRequired == 'true')
            {

                errorInfo.innerHTML = 'Required; ' + patternExpl;

            } else {


                errorInfo.innerHTML = patternExpl;

            }
            errorInfo.setAttribute("class", "error-info");
            elem.parentElement.appendChild(errorInfo);
        }

    } else {
        
        if(elem.parentElement.querySelectorAll(".error-info")[0])
        {
            
            elem.parentElement.removeChild(elem.parentElement.querySelectorAll(".error-info")[0]);
            
        }
        
    }
    
}

function validateInputEvent(e)
{
    
    var inputPattern = e.target.getAttribute('data-pattern'),
        patternRegEx = new RegExp(inputPattern),
        validity = patternRegEx.test(e.target.value);
    
    if(inputPattern && inputPattern.length > 0)
    {
    
        if(validity)
        {

            e.target.removeAttribute('class');
            e.target.setAttribute('data-cannot-send', 'false');

        } else if(!e.target.value.length > 0)
        {
            
            e.target.removeAttribute('class');
            e.target.setAttribute('data-cannot-send', 'true');
            
            if(e.target.getAttribute('data-required') == 'false')
            {
                
                e.target.setAttribute('data-cannot-send', 'false');
                
            }
        
        } else {

            e.target.setAttribute('class','invalid');
            e.target.setAttribute('data-cannot-send', 'true');

        }
    
    }
    
    showErrorMessages(e.target);
    
    changeSubmitState();
    
}


function validateInputOnload(formNode)
{
    
    var inputPattern = formNode.getAttribute('data-pattern'),
        patternRegEx = new RegExp(inputPattern),
        validity = patternRegEx.test(formNode.value);
    
    if(inputPattern && inputPattern.length > 0)
    {
    
        if(validity)
        {

            formNode.removeAttribute('class');
            formNode.setAttribute('data-cannot-send', 'false');

        } else if(!formNode.value.length > 0)
        {
            
            formNode.removeAttribute('class');
            formNode.setAttribute('data-cannot-send', 'true');
            
            if(formNode.getAttribute('data-required') == 'false')
            {
                
                formNode.setAttribute('data-cannot-send', 'false');
                
            }
        
        } else {

            formNode.setAttribute('class','invalid');
            formNode.setAttribute('data-cannot-send', 'true');

        }
    
    }
    
    showErrorMessages(formNode);
    
    changeSubmitState();
    
}

function addTextFieldListener()
{
    
    for(var i = 0; i < formFieldNodes.length; i++)
    {
            
        var origValue = formFieldNodes[i].value;
        
        formFieldNodes[i].addEventListener("focus", modifyTextFieldLabel);
        formFieldNodes[i].addEventListener("blur", modifyTextFieldLabel);
        formFieldNodes[i].focus();
        formFieldNodes[i].blur();
        
        formFieldNodes[i].addEventListener("focus", modifyTooltip);
        formFieldNodes[i].addEventListener("blur", modifyTooltip);
        formFieldNodes[i].addEventListener("input", validateInputEvent);
        
        formFieldNodes[i].addEventListener("onchange", validateInputEvent);
        
        validateInputOnload(formFieldNodes[i]);
        
        
    }
    
}

addTextFieldListener();





