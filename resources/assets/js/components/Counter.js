import React from 'react'

class Counter extends React.Component{

    constructor(props){
        super(props);
        this.state = {count : 0};
    }

    componentDidMount(){
        setInterval(()=>this.tick(), 1000);
    }

    tick(){
        var count = this.state.count+1;
        this.setState({ count });
    }

    render(){
        return <h1>Count {this.state.count}</h1>;
    }

}

export default Counter;
