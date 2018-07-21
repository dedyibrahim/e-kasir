import React, { Component } from 'react';
import ReactDOM from 'react-dom';
class FirstComponent extends Component {
render() {
return (
<div className="firstComponent">
Hello, world! I am a FirstComponent.
</div>
);
}
}
ReactDOM.render(
<FirstComponent />, // Note that this is the same as the variable you stored above
document.getElementById('content')
);