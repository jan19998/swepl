#include <fstream>
#include <iostream>


int main() {
	std::ofstream myfile;
	myfile.open("import.csv");
	for (int i = 0; i < 1000; i++) {
		myfile << "test" << i << "n" << ";" << "test" << i << "v" << ";" << "test" << i << "@fh.de" << ";" << i << "\n";
	}
	myfile.close();
	return 0;
}