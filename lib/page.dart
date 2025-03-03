import 'dart:isolate';

import 'package:flutter/material.dart';

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Padding(
            padding: const EdgeInsets.all(8.0),
            child: ListView(
              children: [
                Image.asset('assets/gifs/gif.gif'),
                buttonClick(
                  onPressed: () => computingCount(),
                  title: "Run with no isolate",
                ),
                buttonClick(
                  onPressed: () async {
                    print("Run with isolate");
                    var sendPort = ReceivePort();
                    await Isolate.spawn(
                        computingCountWithIsolate, [sendPort.sendPort , 10000000000]);
                    sendPort.listen((message) {
                      print("Sum received from isolate: $message");
                      sendPort.close();
                      print(
                          "Data on send port close!"); // Close the ReceivePort when done
                    });
                  },
                  title: "Run with  isolate",
                )
              ],
            )));
  }

  runWithIsolate() async {
    print("Run with isolate");
    ReceivePort sendPort = ReceivePort();
    await Isolate.spawn(computingCountWithIsolate, [sendPort.sendPort, 10000000000]);
    sendPort.listen((message) {
      print("Sum received from isolate: $message");
      sendPort.close();
      print("Data on send port close!"); // Close the ReceivePort when done
    });
  }

  computingCountWithIsolate(List<dynamic> args) {
    var sendPort = args[0] as SendPort;
    int totalRun =  args[1] as int;
    int count = 0;
    for (int i = 0; i < totalRun; i++) {
      count += 1;
    }
    sendPort.send(count);
  }

  int computingCount() {
    int count = 0;
    for (int i = 0; i < 10000000000; i++) {
      count += 1;
    }
    return count;
  }

  buttonClick({String title = 'Click me', required VoidCallback onPressed}) {
    const paddingButton = 8.0;
    double radius = 12;
    const textStyleData = TextStyle(
        color: Colors.white, fontSize: 20, fontWeight: FontWeight.bold);

    return Padding(
      padding: const EdgeInsets.all(paddingButton),
      child: ElevatedButton(
          onPressed: onPressed,
          style: ElevatedButton.styleFrom(
            padding: const EdgeInsets.all(paddingButton + 1),
            backgroundColor: Colors.blue,
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(radius)),
          ),
          child: Text(title, style: textStyleData)),
    );
  }
}
