//import React in our code
import React, { useState } from 'react';

import {
    SafeAreaView,
    StyleSheet,
    View,
    ActivityIndicator,
  } from 'react-native';

import { WebView } from 'react-native-webview';

const ActivityIndicatorElement = () => {
    return (
      <View style={styles.activityIndicatorStyle}>
        <ActivityIndicator color="#009688" size="large" />
      </View>
    );
  };


const ContentView = () => {
    const [visible, setVisible] = useState(false);
    return (
      <SafeAreaView style={{ flex: 1 , marginTop: 40,}}>
        <View style={styles.container}>
          <WebView
            style={{ flex: 1 }}
            //Loading URL
            source={{ uri: 'http://deli-me-app.supsofttech.com/' }}
            //Enable Javascript support
            javaScriptEnabled={true}
            //For the Cache
            domStorageEnabled={true}
            onLoadStart={() => setVisible(true)}
            onLoad={() => setVisible(false)}
          />
          {visible ? <ActivityIndicatorElement /> : null}
        </View>
      </SafeAreaView>
    );
  };


const styles = StyleSheet.create({
  container: {
    backgroundColor: '#F5FCFF',
    flex: 1,
  },
  activityIndicatorStyle: {
    flex: 1,
    position: 'absolute',
    marginLeft: 'auto',
    marginRight: 'auto',
    marginTop: 'auto',
    marginBottom: 'auto',
    left: 0,
    right: 0,
    top: 0,
    bottom: 0,
    justifyContent: 'center',
  },
});



export default ContentView;